<?php

namespace Formatter;

/**
 * JSON Output Formatter
 */
class JSONOutputFormatter implements OutputFormatter
{
    /**
     * Formats a given array to JSON
     * 
     * @param array $value
     * @return array
     * @throws FormatterException
     */
    public function format($value)
    {
        $json = json_encode($value);
        
        if ($json === false)  {
            throw new FormatterException("Unbale format given array into JSON");
        }
        
        return $json;
    }
}
