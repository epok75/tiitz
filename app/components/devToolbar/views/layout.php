<footer id="tiitz-toolbar">
<style scoped>

footer#tiitz-toolbar {
	position: absolute;
	bottom: 0;
	left: 0;
	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	font-size: 14px;
	line-height: 20px;
	color: #333;
	width: 100%;
}
footer#tiitz-toolbar .navbar {
	position: relative;
	overflow: visible;
	width: 100%;
}
footer#tiitz-toolbar .navbar-inner {
	min-height: 40px;
	padding-right: 20px;
	padding-left: 20px;
	background-color: #FAFAFA;
	background-image: -moz-linear-gradient(top,white,#F2F2F2);
	background-image: -webkit-gradient(linear,0 0,0 100%,from(white),to(#F2F2F2));
	background-image: -webkit-linear-gradient(top,white,#F2F2F2);
	background-image: -o-linear-gradient(top,white,#F2F2F2);
	background-image: linear-gradient(to bottom,white,#F2F2F2);
	background-repeat: repeat-x;
	border: 1px solid #D4D4D4;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#fff2f2f2',GradientType=0);
	-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
	-moz-box-shadow: 0 1px 4px rgba(0,0,0,0.065);
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
}
footer#tiitz-toolbar .navbar-inner::before, .navbar-inner::after {
	display: table;
	line-height: 0;
	content: "";
}
footer#tiitz-toolbar .navbar-inner::after {
	clear: both;
}
footer#tiitz-toolbar .navbar .brand {
	display: block;
	float: left;
	padding: 10px 20px 10px;
	margin-left: -20px;
	font-size: 20px;
	font-weight: 200;
	color: #777;
	text-shadow: 0 1px 0 white;
}
footer#tiitz-toolbar .brand > img {
	width: 100%;
	height: 30px;
}
footer#tiitz-toolbar .brand {
	padding : 5px 10px 5px !important;
}
footer#tiitz-toolbar a {
	color: #08C;
	text-decoration: none;
}
footer#tiitz-toolbar .navbar .nav {
	position: relative;
	left: 0;
	display: block;
	float: left;
	margin: 0 10px 0 0;
}
footer#tiitz-toolbar .nav {
	margin-left: 0;
	list-style: none;
}
footer#tiitz-toolbar ul {
	padding: 0;
	margin: 0 0 10px 25px;
}
footer#tiitz-toolbar .navbar .nav > li {
	float: left;
}
footer#tiitz-toolbar .navbar .divider-vertical {
	height: 40px;
	margin: 0 9px;
	border-right: 1px solid white;
	border-left: 1px solid #F2F2F2;
}
footer#tiitz-toolbar li {
	line-height: 20px;
}
footer#tiitz-toolbar .nav {
	list-style: none;
}
footer#tiitz-toolbar .navbar .nav > .active > a, footer#tiitz-toolbar .navbar .nav > .active > a:hover,footer#tiitz-toolbar .navbar .nav > .active > a:focus {
	color: #555;
	text-decoration: none;
	background-color: #E5E5E5;
	-webkit-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);
	-moz-box-shadow: inset 0 3px 8px rgba(0,0,0,0.125);
	box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);
}
footer#tiitz-toolbar .navbar .nav > li > a {
	float: none;
	padding: 10px 15px 10px;
	color: #777;
	text-decoration: none;
	text-shadow: 0 1px 0 white;
}
footer#tiitz-toolbar .nav > li > a {
	display: block;
}
/**
 * Tiitz more info
 */
footer#tiitz-toolbar ul.tiitz-toolbar-info {
	list-style-type: none;
	padding: 0px;
	margin: 0px;
	display: none;
}
footer#tiitz-toolbar ul.nav > li:hover ul.tiitz-toolbar-info {
	display: block;
}
footer#tiitz-toolbar ul.nav > li:hover > a {
	color: #555;
	text-decoration: none;
	background-color: #E5E5E5;
	-webkit-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);
	-moz-box-shadow: inset 0 3px 8px rgba(0,0,0,0.125);
	box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);
}
/* php version */
footer#tiitz-toolbar ul#toolbar-php-version div, footer#tiitz-toolbar ul#toolbar-file-controller div {
	position: absolute;
	bottom: 40px;
	width: 250px;
	height: 100px;
	background-color: yellow;
}
/* tiitz version */
footer#tiitz-toolbar ul#toolbar-tiitz-version div {
	position: absolute;
	left: 0px;
	bottom: 42px;
	width: 250px;
	height: 100px;
	background-color: red;
}
footer#tiitz-toolbar ul#toolbar-file-controller div {
	background-color: green;
}
</style>
	<div class="navbar">
	  	<div class="navbar-inner">
			<a class="brand" href="#"><img src="./tiitz/img/logo-tiitz-mini.png" /></a>
			<ul id="toolbar-tiitz-version" class="tiitz-toolbar-info">
			   	<li>
			   		<div></div>
			   	</li>
			</ul>
			<ul class="nav">
				<li class="divider-vertical"></li>
			   	<li><a href="#"><strong>PHP : </strong><?php echo phpversion(); ?></a>
			   		<ul id="toolbar-php-version" class="tiitz-toolbar-info">
			   			<li>
			   				<div></div>
			   			</li>
			   		</ul>
			   	</li>
			   	<li class="divider-vertical"></li>
			   	<li><a href="#"><?php echo $route['className']; ?> : <?php echo $route['action']; ?></a>
					<ul id="toolbar-file-controller" class="tiitz-toolbar-info">
			   			<li>
			   				<div></div>
			   			</li>
			   		</ul>
			   	</li>
			   	<li class="divider-vertical"></li>
			</ul>
		</div>
	</div>
</footer>
