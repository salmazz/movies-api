# Movies Api Task

* Schedule movie seeder API Service from https://www.themoviedb.org
* Create schedule that runs every Minute to Seed the “recently
  movies” and “top rated movies” max 100 every seed 
  including the movie “genres”
* Store the movies and categories using mysql database
* Create endpoint to list the movies
* Can filter the result by some parameters for example filter by category_id , title , 
  overview,release_date 
* Can sort the result by some parameters for example sort by most popular movies and top_rated desc 

## Installation

All the code required to get started
## Clone
Clone this repo to your local machine using https://github.com/salmazz/movies-api.git
and run
```
git clone https://github.com/salmazz/movies-api.git
cd movies-api
cp .env.example .env
composer install
composer dumpautoload
```

## Database
Setup new Database named "movies_api"

## Docker
Run Docker Desktop app first 

# Laravel sail 
run  ./vendor/bin/sail up -d to setup environment by docker
```
./vendor/bin/sail up -d
```

## Run Migrations
```bash
./vendor/bin/sail artisan migrate
````
## Configure num_of_records , the scheduler interval time , base_url , language 
you can edit in config/movies.php
```
    'num_of_records' => 10,
    'api_key' => env('API_KEY'),
    'base_url'=> 'https://api.themoviedb.org/3/movie/',
    'language'=> 'en-US',
    'cron_expression' => '* * * * *',
```

## Run Queue and job worker

```
./vendor/bin/sail artisan queue:work
./vendor/bin/sail artisan schedule:work
````

## Testing

```
./vendor/bin/sail artisan test
````

## APIs
* List of movies endpoint:  http://movies-api.test/api/movies/list-of-movies
* Available search parameters:  [q, category_id, original_language, release_date and sort_by]
* Example for filtering:  http://movies-api.test/api/movies/list-of-movies?q=title&sort_by=top_rated
 ```
  "data": [
    {
      "movie_id": 843241,
      "backdrop_path": "/7h5WAPAcUzOWpp2jrwHBB48790j.jpg",
      "adult": "false",
      "genre_ids": [
        16,
        28
      ],
      "original_language": "ja",
      "original_title": "劇場版 七つの大罪 光に呪われし者たち",
      "overview": "With the help of the \"Dragon Sin of Wrath\" Meliodas and the worst rebels in history, the Seven Deadly Sins, the \"Holy War\", in which four races, including Humans, Goddesses, Fairies and Giants fought against the Demons, is finally over. At the cost of the \"Lion Sin of Pride\" Escanor's life, the Demon King was defeated and the world regained peace. After that, each of the Sins take their own path.",
      "popularity": 1080.22,
      "poster_path": "/k0ThmZQl5nHe4JefC2bXjqtgYp0.jpg",
      "release_date": "2021-07-02",
      "title": "The Seven Deadly Sins: Cursed by Light",
      "video": "no video for this item",
      "vote_average": 8.4,
      "vote_count": 205,
      "type_of_movie": "popular"
    },
],
```
