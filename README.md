## Manage your money

This is a system made with Laravel and Vue to help keep registered all the earnings and outflows in this financial system, to keep your money organized 🧮💰

### Installation

Clone repository

```
git clone https://github.com/aandresweb/manage-your-money-app
```

Move to folder's project

```
cd manage-your-money-app
```

Run the following script to install **composer.json** dependencies

```
composer i
```

Run the following script to install **package.json** dependencies

```
npm i
```

Rename **.env.example** to just **.env** and set name and credentiales to setup your connection to database

```env
DB_DATABASE=database_example
DB_USERNAME=user_example
DB_PASSWORD=password_example
```

Dont forget generate an APP_KEY, you can do this using this script

```
php artisan key:generate
```

Migrate tables

```
php artisan migrate
```

[DEMO](http://manage-your-money.aandresweb.com/)
