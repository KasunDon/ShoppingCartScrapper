<?php

namespace Parser;

use HTTP\DownloaderInterface;

/**
 * Shopping Cart Parser
 */
class ShoppingCartParser implements ParserInterface
{
    /**
     *
     * @var DownloaderInterface 
     */
    private $httpClient;
    
    /**
     * Constructor
     * 
     * @param DownloaderInterface $httpClient
     */
    public function __construct(DownloaderInterface $httpClient) 
    {
        $this->httpClient = $httpClient;
    }
    
    /**
     * Return scrapped content within given location and routines
     * 
     * @param string $location
     * @return array
     */
    public function extract($location)
    {
       $html = $this->httpClient->download($location);
       $doc = $this->getDOM($html);
       
       $products = array();
       
       $xpath = new \DomXPath($doc);
     
       $cartQuery = "//ul[@class = 'productLister listView']//div[@class = 'productInfo']//h3//a";
       
       $productItems = $xpath->query($cartQuery);
       
       foreach ($productItems as $item) {
           $products[] = $this->populate($item);
       }
       
       return $products;
    }
    
    /**
     * Injecting content into DOMDocuments 
     * 
     * @param type $content
     * @return \DOMDocument
     */
    private function getDOM($content)
    {
       $doc = new \DOMDocument();
       @$doc->loadHTML($content);
       
       return $doc;
    }
    
    /**
     * Pulling out price-floating  number from a given value
     * 
     * @param string $value
     * @return string
     */
    public function findPrice($value) 
    {
        preg_match('/([0-9,]+(\.[0-9]{2})?)/', $value, $matches);
        return $matches[0];
    }
    
    /**
     * Populating product meta data using givem DOMElement
     * 
     * @param \DOMElement $item
     * @return array
     */
    private function populate(\DOMElement $item) 
    {
        $product = array();
        
        //XPath Queries to extract data
        $unitPriceQuery = "//div[@class = 'pricingAndTrolleyOptions']//div[@class = 'priceTab "
               . "activeContainer priceTabContainer']//div[@class = 'pricing']//p";
        $descriptionQuery = "//productcontent//htmlcontent//div[@class = 'productText']";
        
        $title = trim($item->textContent);
        $productHTML = $this->httpClient->download($item->getAttribute('href'));
        $productDOM = $this->getDOM($productHTML);
        $productXPath = new \DOMXPath($productDOM);
        
        $unitPrice = $this->findPrice(trim($productXPath->query($unitPriceQuery)
                ->item(0)->textContent));
        $description = trim($productXPath->query($descriptionQuery)
                ->item(0)->childNodes->item(1)->textContent);
        
        $product['title'] = $title;
        $product['size'] = $this->calculateContentSize($productHTML);
        $product['unit_price'] = $unitPrice;
        $product['description'] = $description;
        
        return $product;
    }
    
    /**
     * Calculates size of a string
     * 
     * @param string $content
     * @return float
     */
    private function calculateContentSize($content) 
    {
        return number_format(mb_strlen($content, 
                mb_detect_encoding($content)) / 1024, 2) . "kb";
    }
}
