<?php
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$password="shikhar123";
$desiredCapabilities = DesiredCapabilities::chrome();
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$web_driver->get("reset password link");
$web_driver->findElement(WebDriverBy::id("newPassword")) ->sendKeys($password);
$web_driver->findElement(WebDriverBy::id("confirmPassword")) ->sendKeys($password);
$web_driver->findElement(WebDriverBy::id("submit"))  ->click();
?>