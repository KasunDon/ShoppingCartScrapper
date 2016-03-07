all: cmd

run:
	php scrapper.php --url="http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html"

test:
	bin/phpspec run --config tests/phpspec.yml

cmd:
	php scrapper.php
	
.PHONY: test all run