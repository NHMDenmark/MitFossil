# Project Setup Documentation

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## Initial Setup

### Laravel Installation

1. Clone project:

    ```bash
    git clone git@github.com:NHMDenmark/MitFossil.git
    ```

2. Install backend packages:

    ```bash
    composer install
    ```

3. Configure environment file:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Set up database connection in .env file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```


### Vue.js Setup

1. Install Vue and dependencies:

    ```bash
    npm install
    ```


## Project Structure

- Frontend Vue components: `resources/js/`
- Backend Laravel controllers: `app/Http/Controllers/`
- API routes: `routes/api.php`
- Web routes: `routes/web.php`
- Auth routes: `routes/auth.php`

## Development Workflow

1. Start Laravel development server:

    ```bash
    php artisan serve
    ```

2. Compile and hot-reload assets:

    ```bash
    npm run dev
    ```


## Deployment Steps

1. Add .htaccess in the root directory (for Apache only):

    ```bash
    <IfModule mod_rewrite.c>
        RewriteEngine on
        RewriteCond %{REQUEST_URI} !^public
        RewriteRule ^(.*)$ public/$1 [L]
    </IfModule>
    ```

2. Build production assets:

    ```bash
    npm run build
    ```

3. Setup database with default data:

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

4. Create symlinks for storage:

    ```bash
    php artisan storage:link
    ```

5. Optimize Laravel:

    ```bash
    php artisan optimize
    php artisan config:cache
    php artisan route:cache
    ```


## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Documentation](https://vuejs.org/guide/introduction.html)
- [Vite Documentation](https://vitejs.dev/guide/)

<aside>
Remember to regularly update dependencies and check for security vulnerabilities using:

```bash
composer update
npm update
composer audit
npm audit
```

</aside>
