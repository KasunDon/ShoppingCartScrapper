<?php

namespace spec\HTTP;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use GuzzleHttp\Client;

class GuzzleDownloaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement('HTTP\DownloaderInterface');
        $this->shouldHaveType('HTTP\GuzzleDownloader');
    }
    
    function it_should_fetch_content_from_given_url() {
        $location = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';
        $htmlOutput = file_get_contents('Tests/Spec/Resources/cart.html');
        
        $this->download($location)->shouldBeString($htmlOutput);
    }
    
    function it_should_throw_an_exception_if_uri_is_null () {
        $this->shouldThrow('\InvalidArgumentException')->duringDownload(null);
    }
    
}
