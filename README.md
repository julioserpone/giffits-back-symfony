# Test Giffits API
This is a basic REST API setup you can use to start a API service.  

---
## Basic setup

### Install packages 
```bash
composer install
```

### Create user in MySQL
Login to the MySQL server via console
```bash
 mysql --user=root
```

Next, create database and user in MySQL
```bash
CREATE DATABASE giffits_test;
GRANT ALL PRIVILEGES ON *.* TO 'giffits-user'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
EXIT;
```

### Configuring the Database
The database connection information is stored as an environment variable called DATABASE_URL. For development, you can find and customize this inside .env:

```bash
DATABASE_URL=mysql://giffits-user:password@127.0.0.1:3306/giffits_test
```

### Migrations: Creating the Database Tables/Schema
We first create the file that will allow us to implement the changes in the database with the following command:

```bash
php bin/console doctrine:migrations:migrate
```

Next, we must execute the following command to apply the database schema changes.:

```bash
php bin/console doctrine:migrations:migrate
```

### Preload sample data with DataFixtures

```bash
php bin/console doctrine:fixtures:load
```

### Start a server
After the installation you need to start a server first via Symfony console:

```bash
php bin/console server:start
```

### Test the API
Navigate to http://127.0.0.1:8000/ to check if the API works properly.

## Example endpoints