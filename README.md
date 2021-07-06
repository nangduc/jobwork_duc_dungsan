## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# jbwork-crm-backend

#### 1. Now run and make sure you have the composer installed on your machine:
 ```
 composer install
 ```
 #### 2. In the next step, open the .env.example file. Change the data of this file to .env and the details of the site, database and email settings
```
DB_DATABASE=database name
DB_USERNAME=your username
DB_PASSWORD=secret

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email address
MAIL_PASSWORD=secret
MAIL_ENCRYPTION=tls
```
#### 3. Set your application key to a random string
```
php artisan key:generate
```

#### 4. Create the encryption keys needed to generate secure access tokens
```
php artisan passport:install
```
##### Before your application can issue personal access tokens, you will need to create a personal access client. You may do this using the passport:client command with the --personal option. If you have already run the passport:install command, you do not need to run this command
```
php artisan passport:client --personal
```

#### 5. After creating your personal access client, place the client's ID and plain-text secret value in your application's .env file
```
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=client-id-value
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=unhashed-client-secret-value
``` 

#### The end! start the laravel server


