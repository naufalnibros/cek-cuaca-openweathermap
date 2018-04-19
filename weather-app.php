<?php
		function curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

  $city   = (isset($_GET['city']) ? $_GET['city'] : NULL );
  $data  = (isset($_GET['city']) ? $_GET['city'] : "" );

	if (isset($city)) {
		$urlContents = curl("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=9b4d049373fb077fdcd6e591a2e573ab");

		$weatherArray = json_decode($urlContents, true);

    if ($weatherArray['cod'] == 200) {
      $weather = "Cuaca di  ".$_GET['city']." saat ini adalah ".$weatherArray['weather'][0]['description'].".";
      $tempInFahrenheit = $weatherArray['main']['temp']*9/5 - 459.67;
			$weather .= " Dengan suhu ".$tempInFahrenheit."&deg;F.";
    } else {
			$weather = NULL;
    }

	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<style type="text/css">
		html {
  background: url(bts2.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

	body {
		background: none;
	}

	.container{
		text-align: center;
		margin-top: 200px;
		width: 450px;
	}

	input{
		margin: 20px 0;
	}

	#weather{
		margin-top: 20px;
	}
	</style>
</head>
<body>

<div class="container" colour="white">
	<h1>What's The Weather?</h1>
	<form method="get">
		<div class="form-group">
			<label for="city">Enter the name of a City</label>
			<input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. New York" value="<?php echo $data;?>">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	<div id="weather">

		<?php

    if (isset($weather)) {
      echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
    } else{
        echo '<div class="alert alert-danger" role="alert">Sorry, that city cloud not be found.</div>';
    }

		?>
	</div>
</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>
