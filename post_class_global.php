<?php
/**
 * 
 */
namespace Facebook\WebDriver;
require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverMouse;


class posts_global
{
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
			        		// 	break;
			        		// }
			        		// if($index>=5)
			        		// {
			        		// 	break;
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
			        // 	$this->post["image"]=$this->get_image($movie,$web_driver);
			        // }
			        // else if($image%5==0)
			        // {
			        // 	$this->post["image"]=$this->get_image($movie,$web_driver);
			        // }
			        // else
			        // {
			        // 	$this->post["image"]="no";
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
		 // 	$element->sendKeys($key."poster");
		 // 	// $web_driver->manage()->timeouts()->implicitlyWait(10);
		 // 	$web_driver->findElement(WebDriverBy::id("sb_form_go"))->click();
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

	function make_post_data($web_driver)
	{
		$dataToPost=array();
		
		// get movie names
		$movie_names=$this->get_names();

		// foreach ($movie_names as $value) 
		// {
		// 	$data=$this->post_data($value);
		// 	if($data!==false)
		// 	{

		// 	}
		// }
		// for ($i=0; $i < count($movie_names) ; $i++)
		for ($i=0; $i < 10 ; $i++) 
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
		// $web_driver->quit();

		$done=$this->post_in_teeme($dataToPost);

        if($done=="done")
        {
        	die();
        }
		// $web_driver->quit();
		// die();
				//  now post the data 

		
	}

	function post_in_teeme($dataToPost)
	{

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
				            // last dev user user9911@teeme.net
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

				 // $web_driver->findElement(WebDriverBy::id("spaceSelect"))->click();
				 // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/select/option[11]"))->click();

				 // /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[2]
				 // /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[7]
				 // /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[11]

				 // $web_driver->wait()->until(
				 //   WebDriverExpectedCondition::titleIs("Home > Dashboard");
				//  $web_driver->get("http://dev.teeme.net/dashboard/index/13/type/1/1");

				//  $web_driver->wait(60,1000)->until(
				//    WebDriverExpectedCondition::titleIs("Home > Dashboard")
				// );

				  $currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[4]/div/div/div/div[2]/ul/li[1]/span/a"))->getAttribute('href');
				 $web_driver->get($currentURL);

		// $add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a"));
					// /html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a/img
						  // $web_driver->findElement(WebDriverBy::id($add))->click();
		// $web_driver->getMouse()->mouseMove($add->getCoordinates());

				 // for ($i=0;$i<count($dataToPost);$i++) 
				 for ($i=0;$i<10;$i++)
				{
					// $start_time = microtime(true);
					$web_driver->manage()->timeouts()->implicitlyWait(50);
					// $web_driver->executeScript("showTimelineEditor();");

					// to find click on add icon
					$web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="postTabUI"]')));
					$web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="postTabUI"]/div[1]')));
					// /html/body/div[5]/div[1]/div[2]/div[1]/div[1]/div
					$isDisplayed=$web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('/html/body/div[5]/div[1]/div[2]/div[1]/div[1]/div')->isDisplayed()));
					if($isDisplayed==true)
					{
						
					}

					$web_driver->wait(60,100)->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("add")));
					// $add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a"))->getAttribute("id");
					// /html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a/img
						  $web_driver->findElement(WebDriverBy::id("add"))->click();
					// $web_driver->executeScript('document.getElementById("add").click();');
					// $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div"));
					// $found=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[1]/div[1]/div/a"));
					// echo "<br>";
					// print_r($found);

					 	// $web_driver->getMouse()->mouseMove($found->getCoordinates());
		// 			 	$web_driver->getMouse()->mouseMove($add->getCoordinates());
		// $web_driver->getMouse()->click();
					 	// $web_driver->executeScript("showTimelineEditor();");

					// 		 	$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("myBtn")));
					// $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("myBtn")));

					// 		 $add=$web_driver->findElement(WebDriverBy::id("add"))->click();

			// 			 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("newPostAdd")));

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
						// 	$web_driver->findElement(WebDriverBy::id("insertImage-1"))
						//             ->click();

						//  $web_driver->manage()->timeouts()->implicitlyWait(10);

						// $web_driver->findElement(WebDriverBy::id("imageByURL-1"))
						//             ->click();


						// 	$web_driver->findElement(WebDriverBy::id("fr-image-by-url-layer-text-1"))
						//             ->sendKeys($dataToPost[$i]["image"]);
						//             $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[1]/form/div[1]/div[1]/div[8]/div[3]/div[2]/button"))->click();
						// $web_driver->manage()->timeouts()->implicitlyWait(10);
						// }

						

						 
						 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("replyCancelButtons")));
						 $web_driver->findElement(WebDriverBy::id("postSubmitButton"))->click();

						  $web_driver->manage()->timeouts()->implicitlyWait(10);
						  
						  // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("timelinePostContents")));

						  $web_driver->manage()->timeouts()->implicitlyWait(10);
						  /*dev server below code uncomment*/
						  $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[4]/input[2]")));
						  $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[4]/input[2]"))->click();
						  // /html/body/div[5]/div[4]/div/div/div[2]/div/form/div[4]/input[2]
						  // $web_driver->executeScript("showTimelineEditor();");

						}
		 

						

						  $web_driver->manage()->timeouts()->implicitlyWait(10);
						  // $end_time = microtime(true);
						  // $execution_time = ($end_time - $start_time);
						  // echo "<br>";
						  // echo " Execution time of script = ".$execution_time." sec";
		 $web_driver->navigate()->refresh();
						  // $web_driver->executeScript('location.reload();');
						

						  $web_driver->manage()->timeouts()->implicitlyWait(10);
					 }
					
						  

						  
						  // $url=$web_driver->getCurrentUrl();
						  // $web_driver->get($url);
					 return "done";
	}
				
}

$posts_500 = new posts_global(); 
	$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$posts_500->make_post_data($web_driver);
	// make_post_data();
?>
