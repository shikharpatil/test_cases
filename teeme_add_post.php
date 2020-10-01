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
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities,1000 * 1000,1000 * 1000);

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


     $web_driver->findElement(WebDriverBy::id("spaceSelect"))->click();
     $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/select/option[46]"))->click();

     $web_driver->wait(60,1000)->until(
       WebDriverExpectedCondition::titleIs("Home > Dashboard")
    );

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
//  $extra_content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor metus vel eleifend volutpat. Vestibulum eu urna ac felis commodo rhoncus. Suspendisse vulputate viverra enim, in tincidunt erat placerat quis. Vestibulum id pretium ipsum. Nunc mauris nunc, pharetra eget vehicula vel, dignissim vel lacus. Proin sem ipsum, porta eu bibendum ut, bibendum eget diam. Duis convallis eleifend urna et sagittis. Morbi mattis vulputate risus quis pharetra. Sed tempor magna ac leo ullamcorper finibus in quis enim. In hac habitasse platea dictumst.

// Donec faucibus a augue sit amet fermentum. Curabitur sed efficitur magna. Etiam porttitor enim et leo interdum, sit amet mollis est suscipit. Vivamus semper neque et urna cursus tincidunt. Donec vulputate ultrices turpis, a ullamcorper sapien mollis feugiat. Quisque risus metus, tempor ut lectus eu, vestibulum molestie dui. In dui neque, porta sed pulvinar ut, facilisis at mauris.";

// $add=$web_driver->getMouse()->mouseMove($add->getCoordinates());
// $add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a"));

for ($i=0;$i<=2;$i++) 
{
  $web_driver->wait(60,100);
          $web_driver->findElement(WebDriverBy::id("postTabUI"));
          $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/div[2]/div[1]")));
          $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/div[2]/div[1]/div")));
          $web_driver->wait(60,100);
           $web_driver->findElement(WebDriverBy::id("add"))->click();
	 // $found=$web_driver->findElements(WebDriverBy::id("add"));
   // if(!empty($found))
   // {

  // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("add")));
  //     $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("add")));
  //          $add=$web_driver->findElement(WebDriverBy::id("add"))->click();

//   $web_driver->manage()->timeouts()->implicitlyWait(50);

//   // $web_driver->executeScript("showTimelineEditor();");

//   $web_driver->getMouse()->mouseMove($add->getCoordinates());
// $web_driver->getMouse()->click();

//   $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div")));
//   $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div")));

 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("newPostAdd")));
 // /html/body/div[5]/div[4]/div/div/div[2]
 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]")));
 
 // /html/body/div[5]/div[4]/div/div/div[2]
 // /html/body/div[5]/div[4]/div/div/div[2]

 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("TimelineEditor")));
 // /html/body/div[5]/div[4]/div/div/div[2]/div
 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div")));

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("formTimeline")));
 // /html/body/div[5]/div[4]/div/div/div[2]/div/form
 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form")));

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[1]/div[3]/div/p")));
 // /html/body/div[5]/div[4]/div/div/div[2]/div/form/div[1]/div[3]/div/p

 $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[1]/div[3]/div/p"))->sendKeys("");

 
 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("replyCancelButtons")));
         $web_driver->findElement(WebDriverBy::id("postSubmitButton"))->click();

          $web_driver->manage()->timeouts()->implicitlyWait(10);
          
          $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("timelinePostContents")));

          $web_driver->manage()->timeouts()->implicitlyWait(10);

          // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[1]/div[2]/span[1]/b")));
          $alert=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[9]"));
          if(!empty($alert))
          {
            
            $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[9]/div")));
            $web_driver->findElement(WebDriverBy::id("popup_ok"))->click();
            $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[4]/input[2]")))->click();

            
          }
          // $web_driver->wait(60,100)->until(WebDriverExpectedCondition::alertIsPresent());
          // $web_driver->switchTo()->alert()->accept();
          // if($alertIs!==null)
          // {
            
          //    $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[4]/input[2]"))->click();
          // }

          $web_driver->manage()->timeouts()->implicitlyWait(10);
   // }
 //   else
 //   {
 //      $web_driver->navigate()->refresh();
 //      $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("add")));
 //           $add=$web_driver->findElement(WebDriverBy::id("add"))->click();

 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("newPostAdd")));

 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("TimelineEditor")));

 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("formTimeline")));
 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form/div[1]/div[3]/div/p")));

 // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form/div[1]/div[3]/div/p"))->sendKeys($extra_content);

 
 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("replyCancelButtons")));
 //         $web_driver->findElement(WebDriverBy::id("postSubmitButton"))->click();

 //          $web_driver->manage()->timeouts()->implicitlyWait(10);
          
 //          $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("timelinePostContents")));

 //          $web_driver->manage()->timeouts()->implicitlyWait(10);
 //          $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form/div[4]/input[2]")));
 //          $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form/div[4]/input[2]"))->click();

 //          $web_driver->manage()->timeouts()->implicitlyWait(10);
 //   }
  // $web_driver->navigate()->refresh();
}

print $web_driver->getTitle();
//$web_driver->quit();
?>