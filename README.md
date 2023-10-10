
## Installation

First clone this repository, install the dependencies, and setup your .env file.

```bash
  git clone https://github.com/sachin53704/project-reporting.git
  composer install
  cp .env.example .env
```

Then create the necessary database and run the initial migrations and seeders.

```bash
  php artisan migrate
  php artisan db:seed --class=UserSeeder
```
Now after run the server by using command
```bash
  php artisan serve
```
Go to generated local server fill the username and password on login page and use the system
```bash
  Username : admin123
  Password : admin123
```
    