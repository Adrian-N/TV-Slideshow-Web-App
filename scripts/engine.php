<?php

//Get Slideshow Settings

	//shared Slides
	if (!empty($_GET["shared"])){
		$shared = $_GET["shared"];
	}else{
		$shared = "YES";
	}
	//Department
	if (!empty($_GET["dep"])){
		$dep = $_GET["dep"];
	}else{
		$dep = "NONE";
	}
	
	//Time for each slide
	if (!empty($_GET["time"])){
		$time = $_GET["time"];
	}else{
		$time = "30";
	}
	$time = $time . "000";
	
	//Time for each slide
	if (!empty($_GET["speed"])){
		$speed = $_GET["speed"];
	}else{
		$speed = "200";
	}
	
	//Slide Reset Time
	if (!empty($_GET["reset"])){
		$reset = $_GET["reset"];
	}else{
		$reset = "30";
	}
	$reset = $reset * 60;
	$reset = $reset . "000";





//Get Slideshow Pictures

	//var
	$exclusionOne = ".";
	$exclusionTwo = "..";
	$exclusionThree = ".bash_history";
	$exclusionFour = ".bash_logout";
	$exclusionFive = ".bash_profile";
	$exclusionSix = ".bashrc";
	$output = "";
	$i = 1;
	//get files
	if ($dep != "NONE"){
		if (file_exists($dep)) {
			$files = scandir($dep);
		}
	}
	$Gfiles = scandir("shared");
	
	// shared Slides
	if ($shared == "YES"){
		foreach ($Gfiles as $Gfile) {
			
		  if ($Gfile !== $exclusionTwo && $Gfile !== $exclusionOne && $Gfile !== $exclusionThree && $Gfile !== $exclusionFour && $Gfile !== $exclusionFive && $Gfile !== $exclusionSix){
			  $output .= "<img src='shared/" . $Gfile ."'>";
			  $i++;
		  }
		}
	}
	
	//Department Slides
	if ($dep != "NONE"){
		if (file_exists($dep)) {
			foreach ($files as $file) {
				
			  if ($file !== $exclusionTwo && $file !== $exclusionOne && $file !== $exclusionThree && $file !== $exclusionFour && $file !== $exclusionFive && $file !== $exclusionSix){
				  $output .= "<img src='" . $dep . "/" . $file ."'>";
				  $i++;
			  }
			}
		}else{
			$dep = "NONE";
		}
	}
	if ($i == 1){
		$output .= "<img src='scripts/error.jpg'>";
	}
?>