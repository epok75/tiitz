<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Web Dev Toolbar</title>
    <link rel="stylesheet" type="text/css" href="../app/components/devToolbar/resources/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="../app/components/devToolbar/resources/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../app/components/devToolbar/resources/css/styles.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>					 
<body>
	<div class="navbar">
	  	<div class="navbar-inner">
	    	<a class="brand" href="#"><img src="../app/components/devToolbar/resources/img/logo.png" /></a>

	    	<ul class="nav">
	    		<li class="divider-vertical"></li>
		    	<li class="active"><a href="#"><strong>PHP : </strong><?php echo phpversion(); ?></a></li>
		    	<li class="divider-vertical"></li>
		      	<li><a href="#"><?php echo $route['className']; ?> : <?php echo $route['action']; ?></a></li>
		      	<li class="divider-vertical"></li>
		      	
		      	
		    </ul>
		</div>
	</div>
<!--
	<div class="container">
		<div class="row-fluid">
		    <div class="span4 show-grid">
		      	
		    </div>
		    <div class="span8 show-grid">
		    	<div class="content"></div>
		      
		    </div>
		</div>
	</div> -->
</body>	
</html>