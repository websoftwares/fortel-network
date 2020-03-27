## System requirements

- PHP 7.4+
- Composer
- Docker (recommended)

## Getting started
Choose below how you would like to install and run the game.

- Local environment
install and run on your local machine where php and composer are installed.

- Docker
build and run from the docker container on the Docker host machine.

### Local environment

1) Install dependencies:

```
php composer.phar install
```

2) Start the game from root folder (not document root):

```
php artisan fortel:play-game
```


### Docker (recommended)

1) Build project:

```
docker build --no-cache -f docker/Dockerfile -t fortel-game .
```

2) Start the game from root folder (not document root):

```
docker run -it fortel-game:latest php artisan fortel:play-game
```

### Testing

Project has `unit` and `feature` tests

### Local environment

1) Run the tests:

```
vendor/bin/phpunit
```

### Docker (recommended)

1) Build project:

```
docker build --no-cache -f docker/Dockerfile -t fortel-game .
```


2) Run the tests:

```
docker run -it fortel-game:latest vendor/bin/phpunit
```

## License
The [MIT](http://opensource.org/licenses/MIT "MIT") License (MIT).
