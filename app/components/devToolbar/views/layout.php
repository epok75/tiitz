<footer id="tiitz-toolbar">
<style scoped>

footer#tiitz-toolbar {
	position: fixed;
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
	min-width: 100px;
	margin-left: -20px;
	font-size: 20px;
	font-weight: 200;
	color: #777;
	text-shadow: 0 1px 0 white;
}
footer#tiitz-toolbar .brand > img#tiitz-logo {
	width: 50px;
	height: 30px;
	margin-right: 10px;
}
footer#tiitz-toolbar .brand > #tiitz-version {
	font-size: 16px;
	position: relative;
}
footer#tiitz-toolbar .brand {
	padding : 5px 5px 5px 10px !important;
}
footer#tiitz-toolbar a {
	color: #08C;
	text-decoration: none;
}
footer#tiitz-toolbar .navbar{
	margin-bottom: 0px;
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
	border : 0px solid #000;
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
footer#tiitz-toolbar div#toolbar-tiitz-version {
	display: none;
	position: absolute;
	left: 2px;
	bottom: 42px;
	width: 648px;
}
footer#tiitz-toolbar div#toolbar-tiitz-version div#toolbar-photo {
	float: left; 
	width : 70px;
}
footer#tiitz-toolbar div#toolbar-tiitz-version div#toolbar-photo img {
	width: 60px;
	height: 60px;
	margin-bottom: 5px;
}
footer#tiitz-toolbar div#toolbar-tiitz-version div#toolbar-content {
	float: left;
	width: 250px;
}
/* tiitz info controller/action */
footer#tiitz-toolbar ul#toolbar-file-controller div {
	background-color: green;
}
/* design block */
footer#tiitz-toolbar .tiitz-toolbar-info {
	background-color: #ffffff;
	border : 1px solid #000;
	padding: 5px;
}
footer#tiitz-toolbar .tiitz-toolbar-info ul li, footer#tiitz-toolbar .tiitz-toolbar-info ul {
	list-style-type: none;
	padding: 0px;
	margin: 0px;
}
footer#tiitz-toolbar .tiitz-toolbar-info ul li {
	float: left;	
	display: inline;
	width: 320px;
	border-bottom: 1px solid #4C4C4C;
	padding: 5px 0px;
	background-color: #ffffff;
	margin-right: 4px;
}
footer#tiitz-toolbar .tiitz-toolbar-info ul li:last-child {
	border-bottom: transparent;
}
footer#tiitz-toolbar div#toolbar-header h2 {
	font-family: "MillerDisplay",Georgia,serif;
	font-size: 13px;
	padding: 0px;
	margin: 0px;
	line-height: 1;
}
footer#tiitz-toolbar div#toolbar-header h2 a {
	color: #000;
	text-transform: uppercase;
}
footer#tiitz-toolbar div#toolbar-header h2 a:hover {
	color: #B80300;
}
footer#tiitz-toolbar div#toolbar-text p {
	font-size: 12px;
	margin: 0px;
	padding: 0px;
}	
.toolbar-clear {
	clear: both;
}
</style>
	<div class="navbar">
	  	<div class="navbar-inner">
			<a class="brand" href="#" id="toolbar-tiitz-info-open">
				<img src="./tiitz/img/logo-tiitz-mini.png" id="tiitz-logo" /> <span id="tiitz-version">0.1</span>
			</a>
			<div id="toolbar-tiitz-version" class="tiitz-toolbar-info" style="display : none;">
			   	<ul>
			   		<li>
			   			<div id="toolbar-photo">
			   				<a href="https://plus.google.com/communities/102794938632806435828">
			   					<img src="./tiitz/img/toolbar-tiitz.png" alt="Tiitz Official Website" />
			   				</a>	
			   			</div>
			   			<div id="toolbar-content">
			   				<div id="toolbar-header">
			   					<h2><a href="https://plus.google.com/communities/102794938632806435828">Site Officiel</a></h2>
			   				</div>
			   				<div id="toolbar-text">
			   					<p>
			   						Documentation, Actualités, Get Started, Tutoriaux, Pluggins, Interviews etc.
			   					</p>
			   				</div>
			   			</div>
			   			<br class="toolbar-clear" />
			   		</li>
			   		<li>
			   			<div id="toolbar-photo">
			   				<a href="https://plus.google.com/communities/102794938632806435828">
			   					<img src="./tiitz/img/toolbar-google-community.png" alt="google+" />
			   				</a>
			   			</div>
			   			<div id="toolbar-content">
			   				<div id="toolbar-header">
			   					<h2><a href="https://plus.google.com/communities/102794938632806435828">Google Communauté</a></h2>
			   				</div>
			   				<div id="toolbar-text">
			   					<p>
			   						Toutes l'actualités de la communauté de Tiitz (News, Bugs, Tutoriaux etc.)
			   					</p>
			   				</div>
			   			</div>
			   			<br class="toolbar-clear" />
			   		</li>
			   		<li>
			   			<div id="toolbar-photo">
			   				<a href="https://groups.google.com/forum/?fromgroups=#!forum/tiitz-framework">
			   					<img src="./tiitz/img/toolbar-google-groups.jpeg" alt="google groups" />
			   				</a>
			   			</div>
			   			<div id="toolbar-content">
			   				<div id="toolbar-header">
			   					<h2><a href="https://groups.google.com/forum/?fromgroups=#!forum/tiitz-framework">Support Technique</a></h2>
			   				</div>
			   				<div id="toolbar-text">
			   					<p>
			   						Google Groupe. Vous avez une interrogation? un problème ? Venez nous en parler.
			   					</p>
			   				</div>
			   			</div>
			   			<br class="toolbar-clear" />
			   			
			   		</li>
			   		<li>
			   			<div id="toolbar-photo">
			   				<a href="https://github.com/epok75/tiitz">
			   					<img src="./tiitz/img/toolbar-github.jpeg" alt="Github" />
			   				</a>
			   			</div>
			   			<div id="toolbar-content">
			   				<div id="toolbar-header">
			   					<h2><a href="https://github.com/epok75/tiitz">Source / Report</a></h2>
			   				</div>
			   				<div id="toolbar-text">
			   					<p>
			   						Consultez, téléchargez les sources officielles du framework Tiitz.
			   					</p>
			   				</div>
			   			</div>
			   			<br class="toolbar-clear" />
			   		</li>
			   		<li>
			   			<div id="toolbar-photo">
			   				<a href="https://www.facebook.com/groups/200728960064145/">
			   					<img src="./tiitz/img/toolbar-facebook.jpeg" alt="Facebook" />
			   				</a>
			   			</div>
			   			<div id="toolbar-content">
			   				<div id="toolbar-header">
			   					<h2><a href="https://www.facebook.com/groups/200728960064145/">Facebook</a></h2>
			   				</div>
			   				<div id="toolbar-text">
			   					<p>
			   						La page Facebook officielle où vous pourrez retrouver toutes les dernières annonces concernant Tiitz.
			   					</p>
			   				</div>
			   			</div>
			   			<br class="toolbar-clear" />
			   		</li>
			   	</ul>
			</div>
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
<script type="text/javascript">
	window.onload = function () {
		var el = document.getElementById("toolbar-tiitz-info-open");

		//console.log(el.tagName);
		el.onclick = function() {
			var div = document.getElementById("toolbar-tiitz-version");

			if(div.style.display == 'none') {
				div.style.display = 'block';
			} else {
				div.style.display = 'none';
			}
		}
	}
	
</script>
