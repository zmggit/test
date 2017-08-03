<?php
namespace LaravelAcademy\UrlScanner\Url;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/8/3
 * Time: 17:07
 */
use GuzzleHttp\Client;
class Scanner
{
    protected $urls;
    protected $httpClient;

    public function __construct(array $urls)
    {
        $this->urls=$urls;
        $this->httpClient=new Client();
    }

    public function getStatusCodeForUrl($url)
    {
        $httpResponse=$this->httpClient->get($url);
        return $httpResponse->getStatusCode();
    }

    public function getInvalidUrls()
    {
        $invalidUrls=[];
        foreach ($this->urls as $url){
            try{
                $statusCode =$this->getStatusCodeForUrl();
            }catch (\Exception $e){
            $statusCode=500;
            }
            if ($statusCode>=400){
                array_push($invalidUrls,['url'=>$url,'status'=>$statusCode]);
            }
            return $invalidUrls;
        }
        
    }

}