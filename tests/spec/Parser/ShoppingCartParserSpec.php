<?php

namespace spec\Parser;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use HTTP\GuzzleDownloader;

class ShoppingCartParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement('Parser\ParserInterface');
        $this->shouldHaveType('Parser\ShoppingCartParser');
    }
    
    function let(GuzzleDownloader $client){
        $this->beConstructedWith($client);
    }
            
    function it_should_extract_all_items_in_shooping_cart(GuzzleDownloader $client) {
        
        $cartLocation = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';
        $cartHTML = file_get_contents('Tests/Spec/Resources/cart.html');

        $client->download($cartLocation)
                ->shouldBeCalled()
                ->willReturn($cartHTML);

        $productLocation = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-apricot-ripe---ready-320g.html';
        $productHTML = file_get_contents('Tests/Spec/Resources/product.html');

        $client->download($productLocation)
                ->shouldBeCalled()
                ->willReturn($productHTML);
        

        $this->extract($cartLocation);
    }
    
    function it_should_filter_price_out_of_a_string() {
        $rawString = "£3.50/unit";
        $expectedValue = "3.50";
        
        $this->findPrice($rawString)->shouldBe($expectedValue);
    }
}
