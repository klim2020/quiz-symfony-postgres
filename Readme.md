**Small quiz to create CRUD App with ability to filter data**


***Requirements***


*PHP 7.4*

*PostgresSQL - installed through Docker after Doctrine installation have been completed*

*Linux Ubuntu*

*symfony cli* https://symfony.com/download

*open 8000 and 5432 ports*

***Installation***


run `git clone https://github.com/klim2020/quiz-symfony-postgres` to download project

run `composer install`  to install  dependencies

run `docker-compse up -d` to start Postgres server

run  `symfony console cache:clear` to clear the cache

run `php bin/console make:migration`  to create migration files

run `php bin/console make:migration:migrate`  to create tables

run `php bin/console doctrine:fixtures:load` to populate table with dummy data

run `symfony server:start -d` to start http server


navigate http://127.0.0.1:8000/exports 

Please Look at the Commits to see development history

![alt text](https://i.imgur.com/zvRhBci.png)
