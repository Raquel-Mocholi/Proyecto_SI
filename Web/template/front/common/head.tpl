<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Turistic APP</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	
	<link rel="apple-touch-icon" href="/data/assets/logo-turistic-icon.png?nocache={rand(10,100)}">
	
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

	<script src="js/jquery-3.3.1.min.js"></script>

	<!-- CSS Files -->
	<link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	
	{assign var=nocache_id value=10|mt_rand:20}
	<link href="css/stylesheet-fo.css?nocache={$nocache_id}" rel="stylesheet" />
	
	<!-- jquery-ui -->
	<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<script src="js/jquery-ui/jquery-ui.min.js"></script>
	
	<script src="js/general.js?nocache={$nocache_id}"></script>
	

	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-_861lMGSKL-WmuIymjpy6IjfyyppeWU"></script>
	
	<script>
		var places={$placesData};
	</script>
</head>
