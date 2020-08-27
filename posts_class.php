<?php
/**
 * 
 */
namespace Facebook\WebDriver;
require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;


class posts
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
		for ($i=164; $i < count($movie_names) ; $i++) 
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

		// $web_driver->quit();
		// die();
				//  now post the data 

		
	}

	function post_in_teeme($dataToPost)
	{
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
		            ->sendKeys("user10@teeme.net");
		 $web_driver->findElement(WebDriverBy::id("userPassword"))
		            ->sendKeys("user10") ;
		 $web_driver->findElement(WebDriverBy::id("remember"))
		            ->click();           
		 $web_driver->findElement(WebDriverBy::id("Submit"))
		            ->click();
		 $web_driver->wait()->until(
		   WebDriverExpectedCondition::titleIs("Home > Dashboard")
		);  
		 $web_driver->manage()->timeouts()->implicitlyWait(10);

		  $currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->getAttribute('href');
		 $web_driver->get($currentURL);

		 for ($i=164;$i<count($dataToPost);$i++) 
		{
					 $add=$web_driver->findElement(WebDriverBy::id("add"))->click();

				 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("newPostAdd")));

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("TimelineEditor")));

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("formTimeline")));

				$content=$dataToPost[$i]["data"];
				 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[4]/div/div/div[2]/div/form/div[1]/div[3]/div/p")))->sendKeys($content);
				 // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[1]/form/div[1]/div[3]/div/p"))->sendKeys($content);

				

				 

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
				  
				  $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("timelinePostContents")));

				  $web_driver->manage()->timeouts()->implicitlyWait(10);

				  $web_driver->navigate()->refresh();
		}
		return "done";
	}
}

$posts_500 = new posts(); 
	$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$posts_500->make_post_data($web_driver);
	// make_post_data();
?>
