# Project for applying to Riverstar
## Deployment

Download project and go to project dir `cd path/to/riverstar-test`

Run commands:

`cp .env.example .env && docker-compose up -d && composer install`

`docker-compose exec web php artisan migrate --seed`

## Usage

**Host**: http://localhost:35

`./Insomnia_riverstar.json` - request collection for insomnia
