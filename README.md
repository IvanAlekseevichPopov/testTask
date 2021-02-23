Test task
==========

Deploying local sandbox:
==========

* ```docker-compose build```
* ```docker-compose up -d```
* ```docker-compose exec --user=www-data php bin/console d:m:m --no-interaction```
* Optional, if you need some dummy initial data: ```docker-compose exec --user=www-data php bin/console doctrine:fixtures:load --no-interaction```
## Entrypoints
* API doc: [/doc](http://localhost/api/doc)
