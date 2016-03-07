# Sainsbury's Shopping Cart Scraper
Simple project to scrape sainsbury's shopping cart items and return data as JSON.

## Setup
Clone this repository and `cd` into it. Then run `composer install` in order to download dependencies.

## RUN
Execute `make test` which will execute all available Test specs. 

To scrape shopping cart (http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html) - Execute `make run` alternatively you can execute following command,

    php scrapper.php --url="http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html"

## Help
Run `make` in order see available cli options for `scraper.php`