# SETUP

This document will serve as a setup guide for this appilcation.

## Technologies
- Docker
- PHP 8.2
- Laravel 10
- Composer
- Angular 

## Docker
The docker-composer.yml includes the following services

### api 
This container runs the backend api laravel application

### app
This container runs the frontend app angular application 

### mysql
This runs the mysql database uses by the backend api for data store

### redis
The redis service is used by the backend api for queuing. The idea is to queue very large 
CSV files and process in batches to avoid over working the server resources

### nginx
This runs the webs server for serving the frontend and backend pages

## Running this application
1. Add these to your `/etc/hosts`
```
127.0.0.1   api.pokemon.test
127.0.0.1   pokemon.test
```

2. From inside the pokemon directory, to build and start the containters
```
docker compose up -d
```

NB: This will try to run the application on the following ports
- 80    : Web server
- 3306  : MySQL server
- 6379  : Redis server
- 4200  : App development server

3. Install composer packages in the backend api
```
docker compose exec -it api composer install
```

4. Run migration and seeders
```
docker compose exec -it api php artisan migrate:fresh --seed
```

5. Running Laravel tests
This application uses the Laravel Pest tests. The test covers the application requirements.
```
docker compose exec -it api php artisan test
```

6. Build the frontend app
```
docker compose exec -it app ng build
```

7. Visit frontend app

- http://pokemon.test

NB: The backend api provides the following endpoints, which  are being called by the frontend

```
GET|HEAD api/pokemons ............................. pokemons.index  › PokemonController@index 
POST     api/pokemons/import ...................... pokemons.import › PokemonController@import 
```
NB: Frontend development enviroment is accessible on http://localhost:4200/

# Screenshots
![screenshot](https://user-images.githubusercontent.com/2041419/224701664-0060e8be-cc43-4784-b15b-04121d44e3e3.jpeg)
