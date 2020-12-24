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
		for ($i=0; $i < 10 ; $i++) 
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

		$host = 'http://localhost:4444/wd/hub';
		$desiredCapabilities = DesiredCapabilities::chrome();
		// $desiredCapabilities->setCapability('acceptSslCerts', true);
		$web_driver = RemoteWebDriver::create($host, $desiredCapabilities,1000 * 1000,1000 * 1000);
		try
		{

			$web_driver->get("http://localhost/teeme_copy3");
			$web_driver->manage()->timeouts()->implicitlyWait(10);
			$web_driver->wait()->until(WebDriverExpectedCondition::titleIs("Teeme"));
			$web_driver->findElement(WebDriverBy::id("place_name1"))->sendKeys("new_place2");
			$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
			$web_driver->manage()->timeouts()->implicitlyWait(10);
			$web_driver->wait()->until(WebDriverExpectedCondition::urlIs("http://localhost/teeme_copy3/new_place2"));
			$web_driver->findElement(WebDriverBy::id("userName"))->sendKeys("jerry@teeme.net");
			            // last dev user user9911@teeme.net
			$web_driver->findElement(WebDriverBy::id("userPassword"))
					->sendKeys("jerrytbb") ;
			$web_driver->findElement(WebDriverBy::id("remember"))
					->click();           
			$web_driver->findElement(WebDriverBy::id("Submit"))
					->click();
			$web_driver->wait()->until(WebDriverExpectedCondition::urlContains("http://localhost/teeme_copy3"));
			$thisUrl=$web_driver->getCurrentUrl();
			if($thisUrl=="http://localhost/teeme_copy3")
			{
		        $web_driver->manage()->timeouts()->implicitlyWait(10);
		        $web_driver->wait()->until(WebDriverExpectedCondition::titleIs("Teeme"));
		        $web_driver->findElement(WebDriverBy::id("place_name1"))
		                            ->sendKeys("new_place2");
		        $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
		        $web_driver->manage()->timeouts()->implicitlyWait(10);
		        $web_driver->wait()->until(
		           WebDriverExpectedCondition::urlIs("http://localhost/teeme_copy3/new_place2"));
		        $web_driver->findElement(WebDriverBy::id("userName"))
		                                    ->sendKeys("jerry@teeme.net");
		                                    // last dev user user9911@teeme.net
		        $web_driver->findElement(WebDriverBy::id("userPassword"))
		                                    ->sendKeys("jerrytbb");
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
				//             try
				//             {
				//             	 $web_driver->wait()->until(
				//    WebDriverExpectedCondition::titleIs("Home > Dashboard")
				// );
				//             }
				//             catch(Exception\TimeoutException $e)
				//             {
				//             	echo "time out handled";

				//             	die();
				//             }
				//  $web_driver->wait()->until(
				//    WebDriverExpectedCondition::titleIs("Home > Dashboard")
				// );  
				$web_driver->manage()->timeouts()->implicitlyWait(10);

				$web_driver->findElement(WebDriverBy::id("spaceSelect"))->click();
				$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/select/option[2]"))->click();

				// /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[2]
				// /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[7]
				// /html/body/div[5]/div[1]/div[2]/ul[1]/select/option[11]

				// $web_driver->wait()->until(
				//   WebDriverExpectedCondition::titleIs("Home > Dashboard");
				//  $web_driver->get("http://dev.teeme.net/dashboard/index/13/type/1/1");

				$web_driver->wait(60,1000)->until(
				WebDriverExpectedCondition::titleIs("Home > Dashboard")
				);

				// check if doc exists or not
				$doc_exists=$web_driver->findElements(WebDriverBy::id("menuDocument"));
				if(!empty($doc_exists))
				{
				 	// echo "yes";
				 	// $web_driver->quit();
				 	$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[2]/span/h1/a"))->click();
				 	$web_driver->wait(60,1000)->until(WebDriverExpectedCondition::titleIs("Teeme > Document"));
				 	// select a document here
				 	// /html/body/div[5]/div[2]/div[2]
				 	$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]")));
				 	// /html/body/div[5]/div[2]/div[2]/div[1]/a
				 	$web_driver->findElement(WebDriverBy::linkText("SpaceDoc16"))->click();
				}
				else
				{
					// call to function to create a document in this case.
					echo "no document exists";
					$web_driver->quit();
				}
				$web_driver->wait(60,1000)->until(WebDriverExpectedCondition::titleContains("Document >"));
				// echo $web_driver->getTitle();
				// $web_driver->quit();
				for($i=0;$i<10;$i++)
				{
					echo " loop ";
					$web_driver->manage()->timeouts()->implicitlyWait(50);
					$web_driver->wait(60,100);
					echo " this element 1 ";
					// $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("aAddNewNote")));
					$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[1]/div[2]/div[4]/div[1]/span[1]/a")));
					// /html/body/div[5]/div[2]/div[1]/div[2]/div[4]/div[1]/span[1]/a
					$web_driver->findElement(WebDriverBy::id("aAddNewNote"))->click();

					// xpath for alert changes according to document
					$alert=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[8]/div/div[1]"));
					// /html/body/div[8]/div/div[1]
					// /html/body/div[9]/div/div[2]
					// /html/body/div[8]/div/div[2]
					// /html/body/div[8]/div
					// /html/body/div[8]/div

						if(!empty($alert))
						{
							echo " in alert ";
							
							$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[8]/div/div[2]/input")));
							// /html/body/div[8]/div/div[2]/input
							// /html/body/div[8]/div/div[2]/input
							// /html/body/div[8]/div/div[2]/input
							$web_driver->findElement(WebDriverBy::id("popup_ok"))->click();
							// $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[3]/div/div/div[2]/div/form/div[4]/input[2]")))->click();
							echo " here ";
							$web_driver->manage()->timeouts()->implicitlyWait(10);
							// $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input"))->click();
							// /html/body/div[5]/div[2]/div[1]/div[2]/div[4]/div[1]/span[1]/a
							echo " here2 ";
							$web_driver->manage()->timeouts()->implicitlyWait(50);
							$alert=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[8]/div/div[1]"));
							// /html/body/div[9]/div/div[1]
							if(!empty($alert))
							{
								echo " still in alert ";
								$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[8]/div/div[2]/input")));
							// /html/body/div[8]/div/div[2]/input
							$web_driver->findElement(WebDriverBy::id("popup_ok"))->click();
							}
							$web_driver->findElement(WebDriverBy::id("aAddNewNote"))->click();
						}
						echo " this element ";
						$web_driver->wait(60,100);
						$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/form")));
						// $web_driver->findElement(WebDriverBy::xpath(""));
					$web_driver->findElement(WebDriverBy::id("leafAddFirst"));

					$content=$dataInLeaves[$i]["data"];
					$editor=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/div/div[3]/div/p"))->sendKeys($content);
					// $is_draft=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/span[1]"));
					echo " content added ";
					$is_draft=$web_driver->findElements(WebDriverBy::id("SaveAsDraftLeafFirst"));
					
					if(!empty($is_draft))
					{
						echo " auto save ";
						// $is_draft_saved=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/span[1]"))->getText();
						$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("displayDraftSaveMessageFirst")));
						$is_draft_saved=$web_driver->findElement(WebDriverBy::id("displayDraftSaveMessageFirst"))->getText();
						if($is_draft_saved=="Drafts saved")
						{
							echo " draft ";
							$web_driver->manage()->timeouts()->implicitlyWait(50);
							$web_driver->wait(60,100);
							$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input"))->click();
						}
						else
						{
							echo " draft else ";
							$web_driver->manage()->timeouts()->implicitlyWait(50);
							$web_driver->wait(60,100);
							$save=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input"));
							if(!empty($save))
							{
								$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]")));
								$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input"))->click();
								// /html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input
							}
							// /html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input
						}
					}
					$web_driver->wait(60,100);
					// $web_driver->wait()->until(WebDriverExpectedCondition::)
					// $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input")));
					// $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]"))->click();
					$editor_open=$web_driver->findElements(WebDriverBy::id("editorLeafContentsAddFirst1"));
					
					if(!empty($editor_open))
					{
						echo " isme ";
						$is_draft=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/span[1]"))->getText();
						if($is_draft=="Drafts saved")
						{
							echo " draft ";
							$web_driver->manage()->timeouts()->implicitlyWait(50);
							$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input"))->click();
						}
						else
						{
							echo " else editor open ";
							$web_driver->wait(60,100);
							$editor_visible=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/div/div[3]/div/p"));
							if(!empty($editor_visible))
							{
								$click_save=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input"))->isDisplayed();
								if($click_save==true)
								{
									echo " final click ";
									$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div/span/div/a[1]/input"))->click();
								}
							}
						}
					}
					else
					{
						echo "usme";
						$web_driver->manage()->timeouts()->implicitlyWait(50);
					}
					$web_driver->manage()->timeouts()->implicitlyWait(50);
					
					 
					// $this->post_count++;
					// $web_driver->manage()->timeouts()->implicitlyWait(10);
					// $send_mail=$this->check_time();
					// if($send_mail==1)
					// {
					// 	$delivered=$this->send_mail();
					// 	if($delivered==1)
					// 	{
					// 		$this->post_count=0;
					// 	}
					// } 
				}

				$web_driver->quit();
                $k=$k+1;
                echo "<br>";
                print_r($k);
                echo "<br>";
				if($k<5)
				{

					// $this->change=$this->change+1;
				    $this->leaves_in_doc($dataInLeaves,$k);
				}
				else
				{
					$web_driver->quit();
					echo "completed";
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
					
		// $url=$web_driver->getCurrentUrl();
		// $web_driver->get($url);
		return "done";
	}
				
}

$document_1lac = new document(); 
$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
$_SESSION['posting']=0;
$document_1lac->make_doc_data($web_driver);
	// make_doc_data();
?>
