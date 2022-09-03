# Rock Scissors Paper Game

Run `docker-compose up -d`

Go to container's console `docker-compose exec php bash`

Run `composer install`

Run `php index.php [rounds] [player 1 name] [player 2 name]`

Game log example:
```
root@439b57fdbb1c:/var/www/html# php index.php 30
  1. [Player-1] Rock vs [Player-2] Scissors -> Player-1
  ...
 30. [Player-1] Paper vs [Player-2] Scissors -> Player-2
 
Player-2 wins (Player-1 7:12 Player-2).
```
