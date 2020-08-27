<?php
// script for adding post in teeme
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
   WebDriverExpectedCondition::titleIs("Teeme"));
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

 // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->click();
 // $web_driver->manage()->timeouts()->implicitlyWait(10);
 $currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->getAttribute('href');
 $web_driver->get($currentURL);
 // $currentURL = $web_driver->getAttribute("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a/@href");
 // print $currentURL;
// $tab = $web_driver->getKeyboard();
// $tab->sendKeys(WebDriverKeys.command,'2');
 // $web_driver->wait()->until(WebDriverExpectedCondition::titleIs("Teeme > Post"));
 // $web_driver->wait()->until(WebDriverExpectedCondition::urlContains("post/web/"));
 
 // $web_driver->manage()->timeouts()->implicitlyWait(10);
 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("add")));
//  $handles = $web_driver->getWindowHandles();
//  $web_driver->getKeyboard()->sendKeys(
// array(WebDriverKeys::COMMAND, ),
// );
 // $web_driver->wait()->until(WebDriverExpectedCondition::numberOfWindowsToBe(2));
 // $web_driver->manage()->timeouts()->implicitlyWait(10);
 // $web_driver->wait()->until(WebDriverExpectedCondition::titleIs("Teeme > Post"));
 // $web_driver->wait()->until(WebDriverExpectedCondition::elementTextIs(WebDriverBy::xpath("/html/head/title"),"Teeme > Post"));
for ($i=0;$i<=3;$i++) 
{
	 $web_driver->findElement(WebDriverBy::id("add"))->click();

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("newPostAdd")));

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("TimelineEditor")));

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("formTimeline")));

 $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form/div[1]/div[3]/div/p"))->sendKeys("hellohjhohfohvjhgdiywteifgweijihdoiwoegyjhdglkjshouwy892730857103");

 
 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("replyCancelButtons")));
 $web_driver->findElement(WebDriverBy::id("postSubmitButton"))->click();
  $web_driver->manage()->timeouts()->implicitlyWait(10);
  
  $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("timelinePostContents")));

  $web_driver->navigate()->refresh();
}

print $web_driver->getTitle();
//$web_driver->quit();
?>