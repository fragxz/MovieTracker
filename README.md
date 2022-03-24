## Filmlog

Welcome to Filmlog - a Movie Tracker application based on Laravel 8.83.5

### Setup Guide:
- Copy and paste all the contents of the archive into the directory of your website, where you want to host the Movie Tracker.
- Now open your terminal and navigate to the directory, where you copied the contents of the Movie Tracker.
- Execute the command "composer install", to install all Composer Packages.
- Execute the command "npm install" and afterwards "npm run dev", to install all Node Packages.
- Create a copy of the file ".env.example" and rename it to ".env".
- Get an OMDb API Key: http://www.omdbapi.com/ and enter it in the ".env" file as the OMDB_API_KEY value.
- Create a new database for this application, if not already done. I recommend "utf8mb4_unicode_ci" as the database collation. Enter and save your database credentials into the ".env" file.
- Enter and execute the command "php artisan migrate" in your terminal, to migrate the database structure.
- Now execute the following command with your terminal: "php artisan key:generate" to generate and set a unique application key.
- The public folder should be configured as your root directory (this may not be needed if run locally. Make sure an Apache and MySQL server, or similar, are running). Update the document root for your website in your webhosting from your CURRENT_PATH to CURRENT_PATH/public.
- If hosted locally, you may need to execute the command "php artisan serve", to start the application!
- When you deploy this website to a public domain, don't forget to set "APP_ENV=production" and "APP_DEBUG=false" in the ".env" file.

### Enjoy!
