<?php
// script for getting 500 movie names
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);

$web_driver->get("https://www.imdb.com/list/ls050782187/");

$web_driver->manage()->timeouts()->implicitlyWait(10);

$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("styleguide-v2")));
$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("lister-list")));
// $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("lister-item mode-detail")));
// $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("lister-item-content")));
$names_500=fopen("movies.txt","a");
for ($i=0; $i < 5 ; $i++) 
{ 

	for ($j=1; $j <=100 ; $j++) 
	{ 
	$xpath="/html/body/div[3]/div/div[2]/div[3]/div[1]/div/div[4]/div[3]/div[".$j."]/div[2]/h3/a";
	$name= $web_driver->findElement(WebDriverBy::xpath($xpath))->getText('href');
	// print_r($name);
	// echo "<br>";
	$movie_name=$name.PHP_EOL;
    
    fwrite($names_500,$movie_name);
    }
    // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("footer filmosearch")));
    $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("list-pagination")));
    // /html/body/div[3]/div/div[2]/div[3]/div[1]/div/div[4]/div[5]/div/div/a[2]
    // /html/body/div[3]/div/div[2]/div[3]/div[1]/div/div[4]/div[5]/div/div/div/a[2]
    
    $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector("a.flat-button:nth-child(3)")));
    // a.flat-button:nth-child(3)
    // a.flat-button:nth-child(3)
    $current_page=$web_driver->findElement(WebDriverBy::cssSelector("a.flat-button:nth-child(3)"))->getAttribute("href");

    $web_driver->findElement(WebDriverBy::cssSelector("a.flat-button:nth-child(3)"))->click();
    // flat-button lister-page-next next-page
    $web_driver->manage()->timeouts()->implicitlyWait(10);

    $web_driver->get($current_page);
    // $web_driver->wait()->until(WebDriverExpectedCondition::urlContains($current_page));


    // $web_driver->navigate()->refresh();

    $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("styleguide-v2")));
    // https://www.imdb.com/list/ls050782187/?sort=list_order,asc&st_dt=&mode=detail&page=3
    
    $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("lister-list")));
}
// /html/body/div[3]/div/div[2]/div[3]/div[1]/div/div[4]/div[3]/div[1]/div[2]/h3/a
// /html/body/div[3]/div/div[2]/div[3]/div[1]/div/div[4]/div[3]/div[1]/div[2]/h3/a
// /html/body/div[3]/div/div[2]/div[3]/div[1]/div/div[4]/div[3]/div[2]/div[2]/h3/a
// /html/body/div[3]/div/div[2]/div[3]/div[1]/div/div[4]/div[3]/div[3]/div[2]/h3/a
  
fclose($names_500);  
print $web_driver->getTitle();
$web_driver->quit();
?>