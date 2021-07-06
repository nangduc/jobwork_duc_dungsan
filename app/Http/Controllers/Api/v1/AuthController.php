<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
  /**
   * Login user and create token
   * @param string email
   * @param string password
   * @param boolean remember_me
   * @return string access_token
   * @return string token_type
   * @return string expires_at
   */
  public function login(LoginRequest $request)
  {
    $credentials = request(['email', 'password']);

    if (!Auth::guard('web')->attempt($credentials)) {
      return response()->json(['message' => 'Incorrect email or password'], 401);
    }

    $user        = Auth::guard('web')->user();

    if (!$user->active) {
      return response()->json(['message' => 'Your account has not been activated!'], 401);
    }
    $tokenResult = $user->createToken('Personal Access Token');
    $token       = $tokenResult->token;
    if ($request->remember_me) $token->expires_at = Carbon::now()->addWeeks(1);
    $token->save();

    return response()->json([
      'message' => 'User Logged In Success!',
      'access_token' => $tokenResult->accessToken,
      'token_type'   => 'Bearer',
      'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
    ]);
  }

  /**
   * Obtain the user information from Google.
   *
   * @return \Illuminate\Http\Response
   */
  public function loginWithSocialAuth(Request $request, $provider)
  {
    try {
      $userGoogle = Socialite::driver($provider)->userFromToken($request->access_token);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th->getMessage()], 400);
    }

    $user = User::where('email', $userGoogle->getEmail())->first();

    if (!$user) {
      return response()->json([
        'message' => 'We cannot find the account associcated with the Google email you just provided.'
      ], 401);
    }
    $tokenResult = $user->createToken('Personal Access Token');
    $token       = $tokenResult->token;
    if ($request->remember_me) $token->expires_at = Carbon::now()->addWeeks(1);
    $token->save();
    return response()->json([
      'message' => 'User Logged In Success!',
      'access_token' => $tokenResult->accessToken,
      'token_type'   => 'Bearer',
      'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
    ]);
  }


  /**
   * Get the name of the user's roles
   * @return array roles array
   */
  public function rolesViaUser()
  {
    $user = auth()->user();
    return $user->getRoleNames();
  }

  /**
   * Get all permissions via roles
   * @return json permissions objects
   */
  public function permissionsViaRoles()
  {
    $user = auth()->user();
    $permissions = [];
    foreach ($user->getPermissionsViaRoles() as $permission) {
      array_push($permissions, [
        'id' => $permission->id,
        'name' => $permission->name
      ]);
    }
    return $permissions;
  }

  /**
   * Get the authenticated user
   * @return json user object
   */
  public function me()
  {
    $user = auth()->user()->only(['id', 'name', 'avatar']);
    return response()->json([
      'user'        => [
        'id'        => $user['id'],
        'name'      => $user['name'],
        'avatar'    => $user['avatar'] ? asset('storage/images/avatars/' . $user['avatar']) : asset('images/avatars/avatar.jpg'),
      ],
      'roles'       => $this->rolesViaUser(),
      'permissions' => $this->permissionsViaRoles()
    ]);
  }

  /**
   * Logout user (revoke the token)
   * @return string message
   */
  public function logout(Request $request)
  {
    $request->user()->token()->revoke();

    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }
}
