# Description

This project is a Task Tracker that work with CLI, allowing users to be able to CRUD tasks. All of those ones are store in a JSON file. As the goal of this project is about improving my own skills with OOP no Framework have been used as any packages that could help me to do this project except those for code style verification,data typing with phpcs-fixer, grumphp,phpstan and phpunit for testing.

# Installation

1 - Clone the repo

2 - Use the package manager [composer](https://getcomposer.org/doc/00-intro.md) to install packages.
```
composer install
```

3 - When grumphp ask you to create a grumphp.yml file , say no and just rename the dist file by removing the keyword "dist". To run grumphp just use the following command :

```
php ./vendor/bin/grumphp run
```

4 - Usually phpstan should not ask you to create a file but if you want to just run it , rename the phpstan.neon dist file by removing the keyword "dist" and refer to [phpstan](https://phpstan.org/user-guide/getting-started) for more informations about how run checks 


3 - Move to this folder : 
```
cd src/Service
```

4 - Lauch the CLI application with the following command :
```
php TaskManagerService.php
```

5 - Lists of commands 

![Commands](https://github.com/user-attachments/assets/d06e0d75-8ed5-47bd-bf80-33d81f81e1d7)

6 - When you're gonna create a task a json file will be created automatically !


# Tests

1 - To run all tests, use the following command :
```
./vendor/bin/phpunit tests
```

2 - To run a specific test, use this one :
```
./vendor/bin/phpunit tests --filter=nameOfTheTest
```

PS : The whole application have not been tested due to a lack of time and knowledge about how testing terminal commands. Only the Task entity and the JsonFile configuration file.

# PHP Version & Packages

- PHP 8.2
- Grumphp ^2.6
- Phpstan ^1.11
- Phpunit 11
- Php-cs-fixer ^3.62


