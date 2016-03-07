<?php

namespace Formatter;

/**
 * Sainsburys Output formatter
 */
class SainsburysOutputFormatter extends JSONOutputFormatter
{
    /**
     * Arrange array elements according Sainsburys format
     * 
     * @param array $value
     * @return array
     */
    public function arrange($value)
    {
        $total = array_reduce($value, function($c, $i){
            $c += $i['unit_price'];
            
            return $c;
        });
        
        return array('results' => $value, 'total' => number_format($total, 2));
    }
    
    /**
     * Converts given array into JSON format
     * @param array $value
     * @return string
     */
    public function format($value) 
    {
        $value = $this->arrange($value);
        return parent::format($value);
    }
}
