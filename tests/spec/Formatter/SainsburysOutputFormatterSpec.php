<?php

namespace spec\Formatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SainsburysOutputFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement('Formatter\JSONOutputFormatter');
        $this->shouldHaveType('Formatter\SainsburysOutputFormatter');
    }
    
    function it_should_format_given_array_into_sainsbury_output_format() 
    {
        $input = array(
            array(
                "title" => "Sainsbury's Apricot Ripe & Ready x5",
                "size" => "0.94kb",
                "unit_price" => "3.50",
                "description" => "Conference")
        );
        
        $expectedValue = '{"results":[{"title":"Sainsbury\'s Apricot Ripe & Ready x5",'
                . '"size":"0.94kb","unit_price":"3.50",'
                . '"description":"Conference"}],"total":"3.50"}';
        
        $this->format($input)->shouldBe($expectedValue);
    }
    
    function it_should_arrange_array_elements_sainsburys_order() 
    {
        $input = array(
            array(
                "title" => "Sainsbury's Apricot Ripe & Ready x5",
                "size" => "0.94kb",
                "unit_price" => "3.50",
                "description" => "Conference")
        );
        
        $expectedValue = array(
            'results' => $input,
            'total' => "3.50"
        );
        
        $this->arrange($input)->shouldBe($expectedValue);
    }
}
