<?php 
	



// =============================== START
// Throught extreme-ip-lookup getting IP and Latitudes and long
	$user_ip = getenv('REMOTE_ADDR');
 $geo = json_decode(file_get_contents("http://extreme-ip-lookup.com/json/"));
 $country = $geo->country;
 $city = $geo->city;
 $ipType = $geo->ipType;
 $businessName = $geo->businessName;
 $businessWebsite = $geo->businessWebsite;
 $lat = $geo->lat;
 $lon = $geo->lon;

 // echo "Location of $city, $country, $lat, -$lon";

// ============================= END
	// $location = ;

	$coordinates = "$lat,-$lon";

    // GET YOUR DARKSKY API FROM api.darksky.net website
    
	$api_url = 'https://api.darksky.net/forecast/YOUR API HERE/'. $coordinates;
	$forecast = json_decode(file_get_contents($api_url));


	// current weather condition
	$current_temp = round($forecast->currently->temperature);
	$summary_current = $forecast->currently->summary;
	//$icon = $forecast->currently->icon;

	$timezone = date_default_timezone_set($forecast->timezone);
	$time = $forecast->currently->time;

	$humidity = $forecast->currently->humidity * 100;
	$pressure = $forecast->currently->pressure;
	$windSpeed = round($forecast->currently->windSpeed);

 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
    <link rel="stylesheet" type="text/css" href="font/">

    <title>Weather Forecast</title>
	</head>
  <body>
    <main class="container text-center">
    	<h1 class="display-1">Weather </h1>
    	<div class="card p-4 mx-auto bg-light" style="max-width: 320;">
    		<h2>Current Weather</h2>
    		<p class="lead m-0"> <?php echo date("l", $forecast->currently->time); ?> </p>
    		
    		<h3 class="display-3"><?php echo $current_temp; ?>&deg;F</h3>
    		<p class="lead"><?php echo $summary_current; ?></p>
    		<p><?php echo get_icon($forecast->currently->icon); ?></p>
    		
    		<p><?php echo $humidity; ?>%</p>
    		<p><?php echo $pressure; ?></p>
    		<p><?php echo $windSpeed; ?><abbr title="miles per hour"> MPH</abbr> </p>
    		
    	</div>

    	<ul class="list-group">
    		<?php 
    		$i = 0;
    		foreach ($forecast->hourly->data as $hour) 
    		{
    		  ?>
    		
    		<li class="list-group-item d-flex justify-content-between">
    			<p class="lead m-0"> <?php echo date("g:i a", $hour->time); ?> </p>
    			<p class="lead m-0"> <?php echo $hour->summary; ?> </p>
    			<p class="lead m-0"> <?php echo $hour->icon; ?> </p>
    			<p class="lead m-0"> <?php echo round($hour->temperature); ?> &deg;</p> 
    			<p class="lead m-0"> <span class="sr_only">Humidity</span> <?php echo $hour->humidity * 100; ?> %</p> 
    			<p class="lead m-0"> <?php echo $hour->pressure; ?> </p> 
    			<p class="lead m-0">Wind Speed <?php echo round($hour->windSpeed); ?> <abbr title="miles per hour"> MPH</abbr> </p>
    			<p><?php echo get_icon($hour->icon); ?></p> </li>
    		
    		<?php

    			$i++;
    			if ($i == 24) break;



    		 //end of foreach loop
    		}
    		  ?>
    	</ul>
    </main>


    <?php 
    	 function get_icon($icon)
    	{		
    		# code...
    		if ($icon === 'clear-day') {
    			# code...
    			$the_icon = '<i class="wi wi-day-sunny display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'clear-night') {
    			# code...
    			$the_icon = '<i class="wi wi-night-clear display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'rain') {
    			# code...
    			$the_icon = '<i class="wi wi-rain display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'snow') {
    			# code...
    			$the_icon = '<i class="wi wi-snow display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'sleet') {
    			# code...
    			$the_icon = '<i class="wi wi-sleet display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'wind') {
    			# code...
    			$the_icon = '<i class="wi wi-strong-wind display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'fog') {
    			# code...
    			$the_icon = '<i class="wi wi-fog display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'cloudy') {
    			# code...
    			$the_icon = '<i class="wi wi-cloudy display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'partly-cloudy-day') {
    			# code...
    			$the_icon = '<i class="wi wi-day-sunny-overcast display-3"></i>';
    			return $the_icon;
    		} elseif ($icon === 'partly-cloudy-night') {
    			# code...
    			$the_icon = '<i class="wi wi-night-alt-partly-cloudy display-3"></i>';
    			return $the_icon;
    		} else {
    			$the_icon = '<i class="wi wi-thermometer display-3"></i>';
    			return $the_icon;
    		}
    	} 
     ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
