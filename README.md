## Filmlog: Your Movie Tracker Application

Welcome to Filmlog, a comprehensive movie tracker built on Laravel 8.83.5. This README provides a structured step-by-step guide to help you set up and enjoy the application.

### 1. Initial Setup:

**Download & Extract:** Download the archive and extract all its contents into the directory of your website where you wish to host Filmlog.
Navigate to Directory: Open your terminal and navigate to the directory where you've extracted the contents.

### 2. Package Installation:

**Composer Packages:**
- Run the command ```composer install``` to install all necessary Composer packages.

**Node Packages:**
- Execute ```npm install``` to install all Node packages.
- Follow it up with ```npm run dev``` to build them.

### 3. Environment Configuration:
1. **Environment File:** Create a copy of the ```.env.example``` file and rename it to ```.env```.
2. **OMDb API Key:** Obtain an OMDb API Key from https://www.omdbapi.com and set it in the **.env** file as the **OMDB_API_KEY** value.
3. **Database Setup:**
   - If you haven't already, create a new database for the application. It's recommended to use **utf8mb4_unicode_ci** as the database collation.
   - Update the **.env** file with your database credentials.
4. **Migrations:** Run the command ```php artisan migrate``` to set up the database structure.
5. **Application Key:** Generate a unique application key by executing php ```artisan key:generate```.

### 4. Server Configuration:

1. **Document Root:** Ensure the public folder is set as your root directory. If you're running the application locally, this step might not be necessary. However, if you're using a web host, update the document root from CURRENT_PATH to CURRENT_PATH/public.
2. **Local Hosting:** If you're hosting the application locally, run ```php artisan serve``` to start it.
3. **Deployment Considerations:** When deploying to a public domain:
    - In your **.env** file set ```APP_ENV=production``` and ```APP_DEBUG=false``` 

### 5. Ready to Go!

Now that you've successfully set up Filmlog, dive in and enjoy tracking your favorite movies!
