<?php
/**
 * 
 */
namespace Facebook\WebDriver;
session_start();
require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverMouse;


class document
{
	public $time1;
	public $time2;
	public $change=0;
	public $post_count=0;
	public $space=0;
	public $post=array();
	public $leaf_count=0;
	function get_names()
	{
		$movie_names=file("movies.txt");
		return $movie_names;
	}
	function doc_data($movie,$image,$web_driver)
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
			        // print_r(strlen($info));
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
			$message = "IP : 172.105.62.87 \r\n Successful post added : ".$this->post_count;
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
	function make_doc_data($web_driver)
	{
		$dataInLeaves=array();
		
		// get movie names
		$movie_names=$this->get_names();

		// foreach ($movie_names as $value) 
		// {
		// 	$data=$this->doc_data($value);
		// 	if($data!==false)
		// 	{

		// 	}
		// }
		// for ($i=0; $i < count($movie_names) ; $i++)
		for ($i=0; $i < 500 ; $i++) 
		{ 
			$data=$this->doc_data($movie_names[$i],$i,$web_driver);
			// echo "<pre>";
			// print_r($data);
			// print_r($movie_names[$i]);
			// echo '<img src= '.$data["image"]. '/>';
			$dataInLeaves[$i]=$data;
			// echo "<br>";
			// print_r($dataInLeaves[$i]);
		}
		// die();
		// echo "<br>";
		// echo "<pre>";
		// print_r($dataInLeaves);
		// echo "<br>";
		// foreach ($dataInLeaves as $value) 
		// {
		// 	print_r(array_filter($value['data'], 'strlen'));
		// }
		$dataInLeaves= array_filter(array_map('array_filter', $dataInLeaves));
		// print_r($dataInLeaves);
		// foreach ($dataInLeaves as $key => $value)
		// 		{
		// 			echo "<br>".$value['data'];
		// 		}
		
		// die();
		$web_driver->quit();
		$k=0;
		$done=$this->leaves_in_doc($dataInLeaves,$k);

        if($done=="done")
        {
        	$message= "done";
        	// mail("shikhar.patil@teambeyondborders.com","mail through php",$message);
        	echo "done";
        	die();
        }
		// $web_driver->quit();
		// die();
				//  now post the data 

		
	}

	function leaves_in_doc($dataInLeaves,$k)
	{

		// $host = 'http://localhost:4444/wd/hub';
		// $desiredCapabilities = DesiredCapabilities::chrome();
		// // $desiredCapabilities->setCapability('acceptSslCerts', true);
		// $web_driver = RemoteWebDriver::create($host, $desiredCapabilities,1000 * 1000,1000 * 1000);
		try
		{
			$add_leaf_api_url="http://localhost/teeme_copy3/api/api_authentication/add_new_leaf_tree";

				foreach ($dataInLeaves as $key => $value)
				{
					$userId=rand(1,4);
					$data=array("treeId"=>1,
						        "treeType"=>"document",
						        "leafOrder"=>0,
						        "curOption"=>"addFirst",
						        "WorkSpaceId"=>3,
						        "workSpaceType"=>1,
						        "leafContent"=>"<p>".$value['data']."</p>",
						        "userId"=>$userId);
					// $data=json_encode($data);

					$data_array=array("data"=>$data);
					$data_array=json_encode($data_array);

					// print_r($data_array);
					// die;

					//initialising the curl session
					$curl_add=curl_init($add_leaf_api_url);
					// curl options
					curl_setopt($curl_add, CURLOPT_POST, true);
					curl_setopt($curl_add, CURLOPT_POSTFIELDS, $data_array);
					curl_setopt($curl_add, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					curl_setopt($curl_add, CURLOPT_RETURNTRANSFER, true);
			         
			         // executing curl and getting response data
					$result = curl_exec($curl_add);
					// check if rresult is true or false
			        if(!$result)
			        {
			          // die("Conection Failure");
			              $this->leaves_in_doc($dataInLeaves,$k);
			        }
			       // closing curl session 
			       curl_close($curl_add);

			        // decoding the json response 
			       $response = json_decode($result, true);

			        // print_r($response);
			       
			       // return $response;

			       $this->leaf_count++;
					
					if($this->leaf_count >= 100000)
					{
						// $web_driver->quit();
						echo "completed count =>".$this->leaf_count;
						die();
					} 
				}

				// $web_driver->quit();
                $k=$k+1;
                echo "<br>";
                print_r($k);
                echo "<br>";
				if($k<401)
				{

					// $this->change=$this->change+1;
				    $this->leaves_in_doc($dataInLeaves,$k);
				}
				else
				{
					// $web_driver->quit();
					echo "completed count =>".$this->leaf_count;
					die();
				}
				// echo $web_driver->getTitle();
				// $web_driver->quit();
	    }
		catch(Exception\NoSuchElementException $e)
		{
			print_r("exception handled");
			$web_driver->quit();
			$this->leaves_in_doc($dataInLeaves,$k);
			// die();
		}
		catch(Exception\TimeoutException $e)
	    {
	    	echo "time out handled";
	    	$web_driver->quit();
			$this->leaves_in_doc($dataInLeaves,$k);
	    	// die();
	    }
	    catch(Exception\ElementNotInteractableException $e)
        {
        	echo "element not interactable";
        	$web_driver->quit();
        	$this->leaves_in_doc($dataInLeaves,$k);
        }
        catch(Exception\StaleElementReferenceException $e)
        {
        	echo "stalemate";
        	$web_driver->quit();
        	$this->leaves_in_doc($dataInLeaves,$k);
        }
        catch(Exception\UnknownErrorException $e)
        {
        	echo "unknown";
        	$web_driver->quit();
        	$this->leaves_in_doc($dataInLeaves,$k);
        }
        catch(Exception\UnrecognizedExceptionException $e)
        {
        	echo "unrecognized count=>".$this->leaf_count;
        	$web_driver->quit();
        	$this->leaves_in_doc($dataInLeaves,$k);
        }
					
		// $url=$web_driver->getCurrentUrl();
		// $web_driver->get($url);
		return "done";
	}
				
}

ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

$document_1lac = new document(); 
$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$_SESSION['posting']=0;
$document_1lac->make_doc_data($web_driver);
	// make_doc_data();
?>
