## Command line instructions

#### Requires

- NodeJs: https://nodejs.org/en
- Composer: https://getcomposer.org/download/

#### Git global setup

```
git config --global user.name "name and lastname"
git config --global user.email "email"
```

#### Clone

```
git clone https://gitlab.com/rainbowriders/dev.mitfossil.dk.git
```

#### Project setup

```
cd dev.mitfossil.dk.git
composer update
npm install
```
- <p> <b>composer update</b> for download laravel dependencies  </p>
- <p> <b>npm install</b> for downlaod vueJs dependencies  </p>

#### Configure database

- <p>Copy file <b>.env.example</b> to <b>.env</b></p>
- Change next values if required:
  - APP_KEY=base64:5+PpH9KfNxQwdgxDKyIQKR8LY1Mvkds5SEb7F7/t40w=
  - DB_HOST=127.0.0.1
  - DB_PORT=3306
  - DB_DATABASE=database_name_db
  - DB_USERNAME=
  - DB_PASSWORD=
- Run next command line

```
php artisan migrate
```

#### Run project

```
php artisan serve
npm run dev
```

- <p> <b>artisan serve</b> for run backend project  </p>
- <p> <b>npm run dev</b> for run frontend project  </p>
