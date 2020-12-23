<!-- /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[17]
/html/body/div[5]/div[1]/div[2]/ul[1]/select/option[18] -->        
<?php
/**
 * 
 */
session_start();
namespace Facebook\WebDriver;
require_once('/var/www/html/vendor/autoload.php');
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverMouse;


class posts
{
	// date_default_timezone_set('Asia/Kolkata');
	public $time1=date('H');
	public $time2;
	public $change=0;
	public $post_count=0;
	public $space=0;
        public $post=array();
        function get_names()
        {
                $movie_names=file("movies.txt");
                return $movie_names;
        }
        function post_data($movie,$image,$web_driver)
        {
                        
                        // $info="";
                        // print_r($movie);
                        // die();

                // $movie = preg_replace('/[^A-Za-z0-9 ]/', '', $movie);
                                $str=str_replace(" ","%20",$movie);
                                $str=rtrim($str);
                                // echo $str;
                                $url = "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=".$str."&format=json";
                                // echo "<br>";
                                // echo $url;
                                // $url = "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=The%20Godfather&format=json";
                                        // $url = 'http://localhost/ci-rest-api/api/student/';
                                        // $data=array("token"=>$token);
                                // initializing a new curl session 
                                $curl = curl_init($url);
                            
                                // curl_setopt($curl, CURLOPT_HEADER, true);
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                // curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                $result = curl_exec($curl);

                                // check for result is true or false
                                if(!$result)
                                {
                                    return false ;
                                }
                                // closing a curl session
                                curl_close($curl);
                                // print_r($result);
                                // die();

                                // decoding the json data into array
                                $response = json_decode($result, true);
                                // echo "<br>";
                                // echo "<pre>";
                                // print_r($response["query"]["search"]);
                                $info='';
                                // $count=count($response["query"]["search"]);
                                $index=0;
foreach ($response["query"]["search"] as $value) 
                                {
                                        
                                        // echo "<br>";
                                        // print_r($value);
                                        // echo "hello";
                                        // foreach ($value as $data) 
                                        // {
                                                // $info=$info.$data;
                                                $info=$info.$value['snippet'];
                                                // if(strlen($info)>1000)
                                                // {
                                                //      break;
                                                // }
                                                // if($index>=5)
                                                // {
                                                //      break;
                                                // }
                                        // }
                                        $index++;
                                        // $post[$i]=$post[$i].$info;
                                }

                                $info = preg_replace('/[^A-Za-z0-9 ]/', '', $info);
                                $info = str_replace("span"," ", $info);
                                $info = str_replace("classsearchmatch"," ", $info);
                                // $info = preg_replace('/\s\s+/', ' ',$info);
                                // $info = str_replace("      "," ", $info);
                                // $info = str_replace("     "," ", $info);
                                // $info = str_replace("    "," ", $info);
                                // $info = str_replace("   "," ", $info);
                                // $info = str_replace("  "," ", $info);
                                $info = preg_replace('/\s+/', ' ',$info);
                                $info=rtrim($info);
                            $info=ltrim($info);
                            $info=strtolower($info);
                                print_r(strlen($info));
                                // echo "<br>";
                                //print_r($info); 
                                // die();
                                $this->post["data"]=$info;
                                echo "<br>";
                        // echo "<pre>";
                        // print_r($info);
                        // echo "<br>";
                                // if($image==5)
                                // {
                                //      $this->post["image"]=$this->get_image($movie,$web_driver);
                                // }
                                // else if($image%5==0)
                                // {
                                //      $this->post["image"]=$this->get_image($movie,$web_driver);
                                // }
                                // else
                                // {
                                //      $this->post["image"]="no";
                                // }
                                
                                // die();
                                return $this->post;
        }
function get_image($movie,$web_driver)
        {
                // echo "<br>";
                // echo $movie;
                // echo "<br>";
                // $key=strtolower($movie)." poster";
                // echo $key;
                // $key=rtrim($key);
                // $key=ltrim($key);
                // echo "<br>".$key;
                // die();
                $key = preg_replace('/[^A-Za-z0-9 ]/', '', $movie)."poster";


                $web_driver->get("https://www.bing.com/images/trending?FORM=ILPTRD");
                        $web_driver->manage()->timeouts()->implicitlyWait(10);
                                 $web_driver->findElement(WebDriverBy::id("sb_form_q"))->sendKeys($key);
                                 $web_driver->manage()->timeouts()->implicitlyWait(10);
                                 $web_driver->findElement(WebDriverBy::id("sb_form_go"))->click();
                 // if($element)
                 // {
                 //     $element->sendKeys($key."poster");
                 //     // $web_driver->manage()->timeouts()->implicitlyWait(10);
                 //     $web_driver->findElement(WebDriverBy::id("sb_form_go"))->click();
                 //    // $element->submit();
                 // }
                 $web_driver->wait()->until(
                   WebDriverExpectedCondition::titleContains("Bing images"));
                //  echo "string";
                        $web_driver->manage()->timeouts()->implicitlyWait(10);
                 $web_driver->findElement(WebDriverBy::id("fltIdtTit"))
                            ->click();
$web_driver->findElement(WebDriverBy::className("ftrLi "))
                            ->click();      
                $web_driver->findElement(WebDriverBy::className("ftrP12"))
                            ->click();      
                            
                            // $web_driver->findElement(WebDriverBy::className("mimg"))
                            // ->click(); 
                $src=$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("mimg")))->getAttribute("src");
                return $src;
        }
        function set_user()
        {
        	$emails=array(0=> "user1@teeme.net",1=>"user10@teeme.net",2=>"user100@teeme.net");
        	$passwords=array(0=> "user1",1=> "user10",2=> "user100");

        	$credentials[0]=$emails[$this->change];
        	$credentials[1]=$passwords[$this->change];

        	return $credentials;
        }
        function send_mail()
        {
        	// 
        	// $to = "patilshikhar@gmail.com";
			// $to = "shikhar.patil@teambeyondborders.com";
			$subject = "Teeme add post script";
			$message = "IP : 172.105.53.252 \r\n Successful post added : ".$this->post_count;
			$headers = array("From: shikhar.patil@teambeyondborders.com",
			   "Reply-To: shikhar.patil@teambeyondborders.com",
			   "X-Mailer: PHP/" . PHP_VERSION
			);
			$headers = implode("\r\n", $headers);
			

			$delivered=mail("patilshikhar@gmail.com",$subject,$message,$headers);
			if($delivered==1)
			{
				return 1;
			}
        }
        function check_time()
        {
        	// 
        	$previous_time=$this->time1;
        	$previuos_time=(int)$previous_time;
        	$this->time2=date('H');
        	$current_time=$this->time2;
        	$current_time=(int)$current_time;
        	if($current_time==0)
        	{
        		$this->time1=$current_time;
        		return 0;
        	}
        	$interval=$current_time-$previous_time;
        	if($interval==1)
        	{
        		$this->time1=$this->time2;
        		return 1;
        	}
        	else 
        	{
        		return 0;
        	}
        }
function make_post_data($web_driver)
        {
                $dataToPost=array();
                
                // get movie names
                $movie_names=$this->get_names();

                // foreach ($movie_names as $value) 
                // {
                //      $data=$this->post_data($value);
                //      if($data!==false)
                //      {

                //      }
                // }
                // for ($i=0; $i < count($movie_names) ; $i++)
                for ($i=0; $i < 50 ; $i++) 
                { 
                        $data=$this->post_data($movie_names[$i],$i,$web_driver);
                        // echo "<pre>";
                        // print_r($data);
                        // print_r($movie_names[$i]);
                        // echo '<img src= '.$data["image"]. '/>';
                        $dataToPost[$i]=$data;
                        // echo "<br>";
                        // print_r($dataToPost[$i]);
                }
                // die();
                // echo "<br>";
                // echo "<pre>";
                // print_r($dataToPost);
                 $web_driver->quit();
                 $k=0;
                 
                 // $user=$this->set_user($this->change);
                $done=$this->post_in_teeme($dataToPost,$k);

        if($done=="done")
        {
               echo $done;
               $web_driver->quit();
                die();
        }
                // $web_driver->quit();
                // die();
                                //  now post the data 

                
        }
 function post_in_teeme($dataToPost,$k)
        {
        	if($this->change==3)
        	{
        		$this->change=0;
        	}
        	$user=$this->set_user($this->change);
        	$username=$user[0];
        	$pass=$user[1];
try
{


                                $host = 'http://localhost:4444/wd/hub';
                                $desiredCapabilities = DesiredCapabilities::chrome();
                                // $desiredCapabilities->setCapability('acceptSslCerts', true);
                                $options = new ChromeOptions();
$options->addArguments(["--no-sandbox","--disable-dev-shm-usage","--headless"]);
$desiredCapabilities->setCapability(ChromeOptions::CAPABILITY, $options);
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
                                            ->sendKeys($username);
                                            // last dev user user9911@teeme.net
                                 $web_driver->findElement(WebDriverBy::id("userPassword"))
                                            ->sendKeys($pass);
                                 $web_driver->findElement(WebDriverBy::id("remember"))
                                            ->click();           
                                 $web_driver->findElement(WebDriverBy::id("Submit"))
                                            ->click();
                                            $web_driver->wait()->until(WebDriverExpectedCondition::urlContains("http://dev.teeme.net"));
                                            $thisUrl=$web_driver->getCurrentUrl();
                                            if($thisUrl=="http://dev.teeme.net/")
                                            {
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
                                            ->sendKeys($username);
                                            // last dev user user9911@teeme.net
                                 $web_driver->findElement(WebDriverBy::id("userPassword"))
                                            ->sendKeys($pass);
                                 $web_driver->findElement(WebDriverBy::id("remember"))
                                            ->click();           
                                 $web_driver->findElement(WebDriverBy::id("Submit"))
                                            ->click();
                                            $web_driver->wait(100,100)->until(
                                   WebDriverExpectedCondition::titleIs("Home > Dashboard"));
                                            }
                                            else
                                            {
                                                   $web_driver->wait(100,100)->until(
                                   WebDriverExpectedCondition::titleIs("Home > Dashboard"));	
                                            }
                                   
                                 $web_driver->manage()->timeouts()->implicitlyWait(10);
                                 if($k<=20)
                                 {
                                 	$this->space=46;
                                 }
                                 else if($k>20 && $k<=40)
                                 {
                                 	$this->space=47;
                                 }
                                 else if($k>40 && $k<=60 )
                                 {
                                 	$this->space=48;
                                 }
                                 else if($k>60 && $k<=80)
                                 {
                                 	$this->space=49;
                                 }
                                 else if($k>80 && $k<=100)
                                 {
                                 	$this->space=50;
                                 }
                                 $web_driver->findElement(WebDriverBy::id("spaceSelect"))->click();
                                 $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/select/option[".$this->space."]"))->click();
                                 // /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[3]

                                 // /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[2]
                                 // /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[7]
                                 // /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[11]

                                 // $web_driver->wait()->until(
                                 //   WebDriverExpectedCondition::titleIs("Home > Dashboard");
                                //  $web_driver->get("http://dev.teeme.net/dashboard/index/13/type/1/1");

                                 $web_driver->wait(60,1000)->until(
                                   WebDriverExpectedCondition::titleIs("Home > Dashboard")
                                );

                                  $currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->getAttribute('href');
                                 $web_driver->get($currentURL);

                // $add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a"));
                                        // /html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a/img
                                                  // $web_driver->findElement(WebDriverBy::id($add))->click();
                // $web_driver->getMouse()->mouseMove($add->getCoordinates());

                                 // for ($i=0;$i<count($dataToPost);$i++) 
                                 for ($i=0;$i<50;$i++)
                                {
                                        // $start_time = microtime(true);
                                        $web_driver->manage()->timeouts()->implicitlyWait(50);
                                        // $web_driver->executeScript("showTimelineEditor();");
                                        
                                        // $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("add")));
                                        // $add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a"))->getAttribute("id");
                                        // /html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a/img
                                                  // $web_driver->findElement(WebDriverBy::id("add"))->click();
                             $web_driver->wait(60,100);
                                      $web_driver->wait(10,100)->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebdriverBy::id("postTabUI")));
                                    $element=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/div[2]/div[1]"));
                                    if(empty($element))
                                     {
                                         echo "ELEMENT no found";
                                            $web_driver->quit();
                                                
                                          $failure = $this->send_failure();
                                            //die("was successful");
                                           $done=$this->post_in_teeme($dataToPost,$k);
                                           
                                        }
                                        else
                                        { 
                           $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/div[2]/div[1]/div");
                                        $web_driver->wait(60,100);
                                                  $web_driver->findElement(WebDriverBy::id("add"))->click();
                                         }            
//$web_driver->findElement(WebdriverBy::xpath(""))->click();
                                        
                                        // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div"));
                                        // $found=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a"));
                                        // echo "<br>";
                                        // print_r($found);

                                                // $web_driver->getMouse()->mouseMove($found->getCoordinates());
                //                              $web_driver->getMouse()->mouseMove($add->getCoordinates());
                // $web_driver->getMouse()->click();
                                                // $web_driver->executeScript("showTimelineEditor();");

                                        //                      $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("myBtn")));
                                        // $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("myBtn")));

                                        //               $add=$web_driver->findElement(WebDriverBy::id("add"))->click();

                        //                       $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("newPostAdd")));

                 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("TimelineEditor")));

                 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("formTimeline")));

 $content=$dataToPost[$i]["data"];
                                                if($content!==null || !empty($content))
                                                {
                                                   
                                                        $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[1]/div[3]/div/p")));
                                                        // /html/body/div[5]/div[2]/div[2]/div[5]/div[1]/form/div[1]/div[3]/div/p
                                                        // /html/body/div[5]/div[4]/div/div/div[2]/div/form/div[1]/div[3]/div/p
         $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[1]/div[3]/div/p"))->sendKeys($content);

                                                

                                                 

                                                // if($dataToPost[$i]["image"]!=="no")
                                                // {
                                                //      $web_driver->findElement(WebDriverBy::id("insertImage-1"))
                                                //             ->click();

                                                //  $web_driver->manage()->timeouts()->implicitlyWait(10);

                                                // $web_driver->findElement(WebDriverBy::id("imageByURL-1"))
                                                //             ->click();


                                                //      $web_driver->findElement(WebDriverBy::id("fr-image-by-url-layer-text-1"))
                                                //             ->sendKeys($dataToPost[$i]["image"]);
                                                //             $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[1]/form/div[1]/div[1]/div[8>
                                                // $web_driver->manage()->timeouts()->implicitlyWait(10);
                                                // }
$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("replyCancelButtons")));
                                                 $web_driver->findElement(WebDriverBy::id("postSubmitButton"))->click();

                                                  $web_driver->manage()->timeouts()->implicitlyWait(10);
                                                  
                                                  $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("timelinePostContents")));

                                                  $web_driver->manage()->timeouts()->implicitlyWait(10);
                                                  /*dev server below code uncomment*/
                                                  // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/>
                                                  // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form/div[4]/input[2]"))->click();
                                                  // /html/body/div[5]/div[4]/div/div/div[2]/div/form/div[4]/input[2]
                                                  // $web_driver->executeScript("showTimelineEditor();");

                                                }
                 

                                                

                                                  $web_driver->manage()->timeouts()->implicitlyWait(10);
                                                  // $end_time = microtime(true);
                                                  // $execution_time = ($end_time - $start_time);
                                                  // echo "<br>";
                                                  // echo " Execution time of script = ".$execution_time." sec";
                                                  $this->post_count++;
                 echo $i;
                 // $web_driver->navigate()->refresh();
                 $alert=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[9]"));
      if(!empty($alert))
      {
            
            $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[9]/div")));
            $web_driver->findElement(WebDriverBy::id("popup_ok"))->click();
            $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[4]/input[2]")))->click();
        }
                                                

                                                  $web_driver->manage()->timeouts()->implicitlyWait(10);
                                                 $send_mail=$this->check_time();
                                                 if($send_mail==1)
                                                 {
                                                 	$delivered=$this->send_mail();
                                                 	if($delivered==1)
                                                 	{
                                                 		$this->post_count=0;
                                                 	}
                                                 } 
                                         }
                                        
                                                  

                                                  
                                                  // $url=$web_driver->getCurrentUrl();
                                                  // $web_driver->get($url);
                                        // return "done";
                                        $web_driver->quit();
                                        $k=$k+1;
if($k<60)
{

	$this->change=$this->change+1;
$this->post_in_teeme($dataToPost,$k);
}
else
{$web_driver->quit();
echo "completed";
die();
}
}
catch(Exception\NoSuchElementException $e)
					{
						print_r("exception handled");
						$web_driver->quit();
						$this->post_in_teeme($dataToPost,$k);
						// die();
					}
					catch(Exception\TimeoutException $e)
				            {
				            	echo "time out handled";
				            	$web_driver->quit();
						$this->post_in_teeme($dataToPost,$k);
				            	// die();
				            }
				            catch(Exception\ElementNotInteractableException $e)
				            {
				            	echo "element not interactable";
				            	$web_driver->quit();
				            	$this->post_in_teeme($dataToPost,$k);
				            }
				            catch(Exception\StaleElementReferenceException $e)
				            {
				            	echo "stalemate";
				            	$web_driver->quit();
				            	$this->post_in_teeme($dataToPost,$k);
				            }
				            catch(Exception\UnknownErrorException $e)
				            {
				            	echo "unknown";
				            	$web_driver->quit();
				            	$this->post_in_teeme($dataToPost,$k);
				            }
        }
                                
}
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$posts_500 = new posts(); 
        $host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
 $options = new ChromeOptions();
$options->addArguments(["--no-sandbox","--disable-dev-shm-usage","--headless"]);
$desiredCapabilities->setCapability(ChromeOptions::CAPABILITY, $options);
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$posts_500->make_post_data($web_driver);
        // make_post_data();
?>

                                      
