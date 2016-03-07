<?php

/**
 * Sainsbury Scrapper factory
 */
class SainsburysScrapper {
    
    /**
     * Scrapes content of given location into Sainsburys JSON output format
     *  
     * @param string $uri
     * @return string
     */
    public static function scrape($uri) 
    {
        $httpClient = new HTTP\GuzzleDownloader();
        $parser = new Parser\ShoppingCartParser($httpClient);
        $formatter = new Formatter\SainsburysOutputFormatter();
        return $formatter->format($parser->extract($uri));
    }
}