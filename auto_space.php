<?php
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);

$web_driver->get("http://dev.teeme.net");
$web_driver->manage()->timeouts()->implicitlyWait(10);
$web_driver->wait()->until(
   WebDriverExpectedCondition::titleIs("Teeme")
);
$web_driver->findElement(WebDriverBy::id("place_name1"))
            ->sendKeys("xyz2");
$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
$web_driver->manage()->timeouts()->implicitlyWait(10);
$web_driver->wait()->until(
   WebDriverExpectedCondition::urlIs("http://dev.teeme.net/xyz2"));

 $web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("mary@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("marytbb") ;
 $web_driver->findElement(WebDriverBy::id("remember"))
            ->click();           
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
 $web_driver->wait()->until(
   WebDriverExpectedCondition::titleIs("Home > Dashboard")
);  
 $web_driver->manage()->timeouts()->implicitlyWait(10);

$currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[2]/li[3]/h1/a"))->getAttribute('href');
 $web_driver->get($currentURL);
// $web_driver->findElement(WebDriverBy::xpath(""))
//             ->click();
            // /html/body/div[5]/div[1]/div[2]/ul[2]/li[3]/h1/a

            $web_driver->wait()->until(
   WebDriverExpectedCondition::titleContains("Create Space")
);  
 $web_driver->manage()->timeouts()->implicitlyWait(10);
 $i=1876;
 $k=0;
 create_spaces($i,$k,$web_driver);
function create_spaces($i,$k,$web_driver)
{
	if($i==10000)
	{
		print $web_driver->getTitle();
		$web_driver->quit();
	}
	else
	{
		$web_driver->findElement(WebDriverBy::id("workSpaceName"))
	            ->sendkeys("samplespace".$i) ;
	 if($k==0)
	 {
	 	$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/table/tbody/tr[3]/td/table/tbody/tr[4]/td[3]/input[2]"))
	            ->click() ;
	 }
	 else
	 {
	     $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/table/tbody/tr[4]/td/table/tbody/tr[4]/td[3]/input[2]"))
	            ->click() ;
	 }
	            // /html/body/div[5]/div[2]/form/table/tbody/tr[4]/td/table/tbody/tr[4]/td[3]/input[2]
	 $web_driver->findElement(WebDriverBy::id("submit"))
	            ->click();
    $web_driver->manage()->timeouts()->implicitlyWait(10);
	$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("tdSpace")));
	$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("successMsg")));
	 if($web_driver->findElement(WebDriverBy::className("successMsg"))
	            ->getText()=="Space has been created successfully")
	            {
	            	$i=$i+1;
	            	$k=1;
	            	create_spaces($i,$k,$web_driver);
	            }

	}
}
 // for ($i=4; $i < 14; $i++) 
 // { 
	    
 // }           
            print $web_driver->getTitle();
// $web_driver->quit();
 
 
?>