#Donation system demo
###Install
1) Install [Docker Compose](https://docs.docker.com/compose/install/)
2) Copy `.env.dist` to `.env` and fill it with your data
3) Run `docer-compose up -d` and wait util it finished
4) Run `docer-compose exec php bash` to connect to PHP container
5) Install vendors with `composer install` [composer](https://getcomposer.org/)
6) Run `composer dev-db-setup`
###Demo
Now demo available on [localhost:6543](http://localhost:6543)