<?php

namespace spec\Formatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JSONOutputFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement('Formatter\OutputFormatter');
        $this->shouldHaveType('Formatter\JSONOutputFormatter');
    }
    
    function it_should_format_given_array_into_json() {
        $input = array(
            array(
                "title" => "Sainsbury's Apricot Ripe & Ready x5",
                "size" => "0.94kb",
                "unit_price" => "3.50",
                "description" => "Conference")
        );
        
        $jsonFormatted = '[{"title":"Sainsbury\'s Apricot Ripe & Ready x5"'
                . ',"size":"0.94kb","unit_price":"3.50","description":"Conference"}]';
        
        $this->format($input)->shouldBe($jsonFormatted);
    }
}
