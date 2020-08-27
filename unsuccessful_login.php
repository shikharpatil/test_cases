<?php
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$web_driver->get("http://dev.teeme.net/demo");

for ($i=0; $i < 10; $i++) 
{ 
 $web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("mary@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("martbb");
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
}
echo $i;
print $web_driver->getTitle();
?>