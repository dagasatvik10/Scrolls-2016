<?php
	ini_set('max_execution_time', 30000);
	$loginCurl= curl_init();							

	$postLoginData= array("TeamId" => substr(trim($_POST['teamId']),7), 
							"Password" =>$_POST['password']); 
	curl_setopt_array($loginCurl, array( CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
											CURLOPT_RETURNTRANSFER => 1,
											CURLOPT_URL => 'http://localhost:8080/api/Teams/IsTeamValid',
											CURLOPT_POST => 1,
											CURLOPT_POSTFIELDS => json_encode($postLoginData),
										));

	 $success = curl_exec($loginCurl);
	 $success=json_decode($success);
	 $success=(array)$success;
	 $teamIds=$success["TeamId"];
		curl_close($loginCurl);
	//print_r(json_encode($postLoginData));
	$scrollsIdCurl= curl_init();
	$url= "http://localhost:8080/api/Teams/GetTeam?teamId=".trim($teamIds);
	//echo $url;
	curl_setopt_array($scrollsIdCurl, array( CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
											CURLOPT_RETURNTRANSFER => 1,
											CURLOPT_URL => $url,
										));
	//var_dump($scrollsIdCurl);
	$scrollIdResponse= curl_exec($scrollsIdCurl);
	$scrollIdResponse=json_decode($scrollIdResponse);
	curl_close($scrollsIdCurl);
	  //var_dump($scrollIdResponse);
	$scrollIdResponse=(array)$scrollIdResponse;
	  //var_dump($success);
	  //var_dump($scrollIdResponse);
	if (isset($success) && isset($scrollIdResponse)) 
	{
		
		
		session_start();
		$_SESSION["TeamId"] =$_POST['teamId'];
		$_SESSION["DomainName"]=$success["DomainName"];
		$_SESSION["TopicName"]=$success["TopicName"];
		$_SESSION["TeamName"]=$scrollIdResponse["TeamName"];
		$_SESSION["SynopsisAvailable"]=$scrollIdResponse["SynopsisAvailable"];

		header("location: home.php");
	}
	else
	{
		echo "<script language='javascript'>alert('Invalid Credentials'); location.href='index.php'; </script>"; 
	    
	}

?>