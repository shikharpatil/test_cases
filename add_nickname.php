<?php
namespace Facebook\WebDriver;
session_start();
require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverMouse;

class nickname
{
	function open_window($web_driver)
	{
		// $host = 'http://localhost:4444/wd/hub';
		// $desiredCapabilities = DesiredCapabilities::chrome();
		// // $desiredCapabilities->setCapability('acceptSslCerts', true);
		// $web_driver = RemoteWebDriver::create($host, $desiredCapabilities,1000 * 1000,1000 * 1000);

		$web_driver->get("http://dev.teeme.net");
		$web_driver->manage()->timeouts()->implicitlyWait(10);
		$web_driver->wait()->until(WebDriverExpectedCondition::titleIs("Teeme"));
		$web_driver->findElement(WebDriverBy::id("place_name1"))->sendKeys("post_july_21");
		$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
		$web_driver->manage()->timeouts()->implicitlyWait(10);
		$web_driver->wait()->until(WebDriverExpectedCondition::urlIs("http://dev.teeme.net/post_july_21"));
		$web_driver->findElement(WebDriverBy::id("userName"))->sendKeys("mary@teeme.net");
		$web_driver->findElement(WebDriverBy::id("userPassword"))->sendKeys("marytbb") ;
		$web_driver->findElement(WebDriverBy::id("remember"))->click();           
		$web_driver->findElement(WebDriverBy::id("Submit"))->click();
		$web_driver->wait()->until(WebDriverExpectedCondition::urlContains("http://dev.teeme.net"));
      $thisUrl=$web_driver->getCurrentUrl();
      if($thisUrl=="http://dev.teeme.net")
      {
         $web_driver->manage()->timeouts()->implicitlyWait(10);
         $web_driver->wait()->until(WebDriverExpectedCondition::titleIs("Teeme"));
         $web_driver->findElement(WebDriverBy::id("place_name1"))->sendKeys("post_july_21");
         $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
         $web_driver->manage()->timeouts()->implicitlyWait(10);
         $web_driver->wait()->until(WebDriverExpectedCondition::urlIs("http://dev,teeme.net"));
         $web_driver->findElement(WebDriverBy::id("userName"))->sendKeys("mary@teeme.net");
         $web_driver->findElement(WebDriverBy::id("userPassword"))->sendKeys("marytbb");
         $web_driver->findElement(WebDriverBy::id("remember"))->click();           
         $web_driver->findElement(WebDriverBy::id("Submit"))->click();
         // $web_driver->wait()->until(WebDriverExpectedCondition::urlContains("terms_and_conditions"));
         // /html/body/div[5]/div/form/div[3]/input[1]
         $web_driver->wait()->until(WebDriverExpectedCondition::urlContains("http://dev.teeme.net"));
         // $thisUrl=$web_driver->getCurrentUrl();
         // if($thisUrl=='http://localhost/teeme_copy/terms_and_conditions')
         // {
         //    $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div[3]/input[1]"))->click();
         //    $web_driver->wait(100,100)->until(WebDriverExpectedCondition::titleIs("Teeme"));

         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[3]/div[2]/input'))->sendKeys("jimtbb");
         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[4]/div[2]/input'))->sendKeys("jimtbb");
         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[5]/div[2]/input'))->sendKeys("jimtbb");
         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[6]/div[2]/input'))->click();
         // }
         $web_driver->wait(100,100)->until(WebDriverExpectedCondition::titleIs("Home > Work Board"));
      }
      else
      {
         // $web_driver->wait()->until(WebDriverExpectedCondition::urlContains("http://localhost/teeme_copy2"));
         // $thisUrl=$web_driver->getCurrentUrl();
         // if($thisUrl=='http://localhost/teeme_copy2/terms_and_conditions')
         // {
         //    $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div[3]/input[1]"))->click();
         //    $web_driver->wait(100,100)->until(WebDriverExpectedCondition::titleIs("Teeme"));

         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[3]/div[2]/input'))->sendKeys("jimtbb");
         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[4]/div[2]/input'))->sendKeys("jimtbb");
         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[5]/div[2]/input'))->sendKeys("jimtbb");
         //    $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/form/div/div[6]/div[2]/input'))->click();
         // }
         $web_driver->wait(100,100)->until(
         WebDriverExpectedCondition::titleIs("Home > Work Board"));
         
      }

      /*
      // $web_driver->findElement(WebDriverBy::xpath('/html/body/div[4]/div/div/div/div[2]/ul/li[1]/a[2]'))->click();
      // $web_driver->manage()->timeouts()->implicitlyWait(10);
      // echo "preferences opened ";
      // $web_driver->wait(100,100)->until(WebDriverExpectedCondition::titleIs("Teeme > Preferences"));
      // $web_driver->wait(100,100)->until(WebDriverExpectedCondition::urlContains("preference"));
      // echo "looking for profile ";
      // $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('/html/body/div[5]/div[2]/div/ul/li[1]/a')));
      // echo "looking for input nickname ";
      // $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('/html/body/div[5]/div[2]/div/div/div[1]/form/div[3]/div[2]/table/tbody/tr[6]/td[2]/input')));
      // // echo "looking for click name";
      // // $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/div/div/div[1]/form/div[3]/div[2]/table/tbody/tr[6]/td[2]/input'))->click();
      // echo "looking for sending keys ";            
      // // $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/div/div/div[1]/form/div[3]/div[2]/table/tbody/tr[6]/td[2]/input'))->sendKeys('hari');
      // $web_driver->findElement(WebDriverBy::id('nickName'))->sendKeys('jim');
      // echo "save ";
      // $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/div/div/div[1]/form/div[3]/div[4]/input[7]'))->click();
      // echo "about ";
      // $web_driver->wait(100,100)->until(WebDriverExpectedCondition::urlContains("about"));
      // $web_driver->findElement(WebDriverBy::xpath('/html/body/div[4]/div/div/div/div[2]/ul/li[3]/a'))->click();
      // $web_driver->quit();	
      // http://localhost/teeme_copy2/manage_workplace
      //*[@id="right"]/ul/li[1]/a[2]
      // /html/body/div[4]/div/div/div/div[2]/ul/li[1]/a[2]
      // $web_driver->get("http://localhost/teeme_copy2/manage_workplace");

      // /html/body/div[5]/div[2]/div[3]/div[7]/a[1]/img
      // /html/body/div[5]/div[2]/div[3]/div[11]/a[1]
      */
      $web_driver->get('http://dev.teeme.net/view_workplace_members');
      $web_driver->manage()->timeouts()->implicitlyWait(10);
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::titleIs("Teeme > View Members"));
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('container')));
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('leftSideBar')));
      $web_driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
      $web_driver->manage()->timeouts()->implicitlyWait(10);
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('/html/body/div[5]/div[2]/div[3]/div[40035]/a[1]')));
      // $web_driver->switchTo
      // echo "hello";
      print_r($web_driver->getWindowHandle());
      $return=$this->add_nickname($web_driver);
      
   }
   
   function add_nickname($web_driver)
   {
      $url='http://dev.teeme.net/edit_workplace_member/index/10';
      $web_driver->executeScript("window.open('".$url."','_blank');");
      $web_driver->manage()->timeouts()->implicitlyWait(10);
      echo "tab opened ";
      // $web_driver->close();
      print_r($web_driver->getWindowHandles());
      $wHandle=$web_driver->getWindowHandles();
      $web_driver->switchTo()->window($wHandle[1]);
      // $web_driver->quit();
      // $web_driver->close();
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::titleIs("Teeme > Edit Member"));
      echo "title read ";
      print_r($web_driver->getTitle());
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('/html/body/div[5]/div[2]/table/tbody/tr/td/form')));
      $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/table/tbody/tr/td/form'));
      echo "form detected";
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('nickName')));
      echo "input box detected ";
      $web_driver->manage()->timeouts()->implicitlyWait(50);
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('/html/body/div[5]/div[2]/table/tbody/tr/td/form/table[1]/tbody/tr[7]/td[1]')));
      // $web_driver->findElement(WebDriverBy::id('nickName'))->click();
      $web_driver->findElement(WebDriverBy::id('nickName'))->sendKeys('user2');
      echo "keys sent ";
      // /html/body/div[5]/div[2]/table/tbody/tr/td/form/table[2]/tbody/tr/td[3]/input[6]
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('/html/body/div[5]/div[2]/table/tbody/tr/td/form/table[2]/tbody/tr/td[3]/input[6]')));
      echo "submit button detected ";
      $web_driver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/table/tbody/tr/td/form/table[2]/tbody/tr/td[3]/input[6]'))->click();
      echo "submit button clicked ";
      $web_driver->manage()->timeouts()->implicitlyWait(50);
      $web_driver->wait(100,100)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('wrap1')));
      $web_driver->close();
   }
}

$nick = new nickname(); 
$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
// $web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities,1000 * 1000,1000 * 1000);
// $_SESSION['posting']=0;
$nick->open_window($web_driver);
?>
