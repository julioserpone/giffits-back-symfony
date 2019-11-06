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

Next, create user in MySQL
```bash
GRANT ALL PRIVILEGES ON *.* TO 'giffits-user'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
EXIT;
```

### Configuring the Database
The database connection information is stored as an environment variable called DATABASE_URL. For development, you can find and customize this inside .env:

```bash
DATABASE_URL=mysql://giffits-user:password@127.0.0.1:3306/giffits-test
```

### Start a server
After the installation you need to start a server first via Symfony console:

```bash
php bin/console server:start
```

### Test the API
Navigate to http://127.0.0.1:8000/ to check if the API works properly.

## Example endpoints