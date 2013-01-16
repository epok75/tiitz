<footer id="tiitz-toolbar">
<style scoped>
p {
	margin: 0px;
	padding: 0px;
	line-height: 1.2;
}
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
footer#tiitz-toolbar .navbar .nav > .active > a, 
footer#tiitz-toolbar .navbar .nav > .active > a:hover, 
footer#tiitz-toolbar .navbar .nav > .active > a:focus {
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
ul#toolbar-php-version > li > div, 
ul#toolbar-file-controller > li > div,
ul#toolbar-tiitz-info > li > div {
	position: absolute;
	bottom: 40px;
	min-width: 300px;
	min-height: 200px;
	background-color: #fff;
	padding: 5px;
	border: 1px solid #000;
}

/* tiitz Site Aide */
footer#tiitz-toolbar div#toolbar-tiitz-version {
	width: 310px;
	left: -20px;
}
footer#tiitz-toolbar div#toolbar-tiitz-version ul li {
	width: 100%;
	border-bottom: 1px solid #4C4C4C;
	padding: 5px 0px;
	background-color: #ffffff;
	margin-right: 4px;
}
footer#tiitz-toolbar div#toolbar-tiitz-version ul li:last-child {
	border-bottom: transparent;
}
footer#tiitz-toolbar div#toolbar-header h2  {
	font-size: 13px;
	padding: 0px;
	padding-bottom: 5px;
	margin: 0px;
	line-height: 1;
	text-transform: uppercase;
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
footer#tiitz-toolbar div#toolbar-tiitz-version div#toolbar-photo {
	float: left; 
	width : 50px;
}
footer#tiitz-toolbar div#toolbar-tiitz-version div#toolbar-photo img {
	width: 40px;
	height: 40px;
	margin-bottom: 5px;
}
footer#tiitz-toolbar div#toolbar-tiitz-version div#toolbar-content {
	float: left;
	width: 250px;
}
/* tiitz info systeme performance */
footer#tiitz-toolbar ul#toolbar-php-version h2 {
	background-color: #000;
	font-family: "MillerDisplay",Georgia,serif;
	font-size: 16px;
	padding: 0px;
	margin: 0px;
	line-height: 1;
	color: #f1f1f1;
	padding: 10px 5px;
	text-transform: uppercase;
}
footer#tiitz-toolbar ul#toolbar-php-version ul#toolbar-php-version-detail > li {
	width: 100%;
}
footer#tiitz-toolbar ul#toolbar-php-version ul#toolbar-php-version-detail h3 {
	font-family: "MillerDisplay",Georgia,serif;
	font-size: 15px;
	padding: 0px;
	margin: 0px;
	line-height: 1;
	margin: 10px 0px;
}
/* tiitz info controller/action */
footer#tiitz-toolbar ul#toolbar-file-controller > li > div  {
	min-width: 200px;
	min-height: 70px;
}
/* tiitz info configuration */
footer#tiitz-toolbar ul#toolbar-config > li > div, footer#tiitz-toolbar ul#toolbar-log-error {
	position: absolute;
	min-width: 200px;
	min-height: 70px;
	bottom: 40px;
	background-color: #fff;
	padding: 5px;
	border: 1px solid #000;
}
/* tiitz error log */
footer#tiitz-toolbar ul#toolbar-log-error {
	width: 700px;
	height: 500px;
	padding: 0px;
	bottom: 44px;
	overflow: auto;
}
.odd, .even {
	padding: 5px;
	
	text-align: left;
	vertical-align: top;
}
footer#tiitz-toolbar ul#toolbar-log-error .odd {
	background-color: #F9F9F9;
	border-top: 1px solid #DDD;
}
footer#tiitz-toolbar ul#toolbar-log-error .even {
	border-top: 1px solid #DDD;
}
.odd:hover, .even:hover {
	background-color: whiteSmoke;
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
.toolbar-clear {
	clear: both;
}
</style>

	<div class="navbar">
	  	<div class="navbar-inner">
	  		<ul class="nav">
				<li>	
					<a class="brand" href="#">
						<img src="<?php print WEB_PATH; ?>tiitz/img/logo-tiitz-mini.png" id="tiitz-logo" /> <span id="tiitz-version"><?php print Tiitz::getTiitzVersion(); ?></span>
					</a>
					<ul id="toolbar-tiitz-info" class="tiitz-toolbar-info">
						<li>
							<div id="toolbar-tiitz-version" class="tiitz-toolbar-info">
							   	<ul>
							   		<li>
							   			<div id="toolbar-photo">
							   				<a href="https://plus.google.com/communities/102794938632806435828">
							   					<img src="<?php print WEB_PATH; ?>tiitz/img/toolbar-tiitz.png" alt="Tiitz Official Website" />
							   				</a>	
							   			</div>
							   			<div id="toolbar-content">
							   				<div id="toolbar-header">
							   					<h2><a href="https://plus.google.com/communities/102794938632806435828">Site Officiel</a></h2>
							   				</div>
							   				<div id="toolbar-text">
							   					<p>
							   						Documentation, Actualit&eacute;s, Get Started, Tutoriaux, Pluggins, Interviews etc.
							   					</p>
							   				</div>
							   			</div>
							   			<br class="toolbar-clear" />
							   		</li>
							   		<li>
							   			<div id="toolbar-photo">
							   				<a href="https://plus.google.com/communities/102794938632806435828">
							   					<img src="<?php print WEB_PATH; ?>/tiitz/img/toolbar-google-community.png" alt="google+" />
							   				</a>
							   			</div>
							   			<div id="toolbar-content">
							   				<div id="toolbar-header">
							   					<h2><a href="https://plus.google.com/communities/102794938632806435828">Google Communaut&eacute;</a></h2>
							   				</div>
							   				<div id="toolbar-text">
							   					<p>
							   						Toutes l'actualit&eacute;s de la communaut&eacute; de Tiitz (News, Bugs, Tutoriaux etc.)
							   					</p>
							   				</div>
							   			</div>
							   			<br class="toolbar-clear" />
							   		</li>
							   		<li>
							   			<div id="toolbar-photo">
							   				<a href="https://groups.google.com/forum/?fromgroups=#!forum/tiitz-framework">
							   					<img src="<?php print WEB_PATH; ?>/tiitz/img/toolbar-google-groups.jpeg" alt="google groups" />
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
							   					<img src="<?php print WEB_PATH; ?>/tiitz/img/toolbar-github.jpeg" alt="Github" />
							   				</a>
							   			</div>
							   			<div id="toolbar-content">
							   				<div id="toolbar-header">
							   					<h2><a href="https://github.com/epok75/tiitz">Source / Report</a></h2>
							   				</div>
							   				<div id="toolbar-text">
							   					<p>
							   						Consultez, t&eacute;l&eacute;chargez les sources officielles du framework Tiitz.
							   					</p>
							   				</div>
							   			</div>
							   			<br class="toolbar-clear" />
							   		</li>
							   	</ul>
							</div>
						</li>	
					</ul>	
				</li>
				<li class="divider-vertical"></li>
			   	<li><a href="#"><strong>PHP : </strong><?php echo phpversion(); ?></a>
			   		<ul id="toolbar-php-version" class="tiitz-toolbar-info">
			   			<li>
			   				<div>
			   					<h2>Configuration php.ini</h2>
			   					<ul id="toolbar-php-version-detail">
			   						<li>
			   							<div>
			   								<h3>Sécurités</h3>
			   								<ul>
			   									<li><strong>allow_url_fopen : </strong> <?php $ini['allow_url_fopen'] == 1 ? print '<span style="color:red;">True</span>' : print 'False'; ?></li>
			   									<li>
			   										<strong>register_globals : </strong>
			   										<?php  ini_get('register_globals') ? print ini_get('register_globals') : print 'Supprimé<sup>*</sup>'; ?>
			   									</li>
			   									<li>
			   										<strong>magic_quotes_gpc : </strong>
			   										<?php ini_get('magic_quotes_gpc') ? print ini_get('magic_quotes_gpc') : print 'Supprimé<sup>*</sup>';  ?>
			   									</li>
			   									<li>
			   										<strong>open_basedir : </strong>
			   										<?php echo ini_get('open_basedir'); ?></li>
			   									<li>
			   										<strong>safe_mode : </strong>
			   										<?php ini_get('safe_mode') ? print ini_get('safe_mode') : print 'Supprimé<sup>*</sup>'; ?>
			   									</li>
			   								</ul>
			   							</div>
			   						</li>
			   						<li>
			   							<div>
			   								<h3>Upload</h3>
			   								<ul>
			   									<li><strong>file_uploads : </strong><?php echo $ini['file_uploads']; ?></li>
			   									<li><strong>max_file_uploads : </strong><?php echo $ini['max_file_uploads']; ?></li>
			   									<li><strong>upload_max_filesize : </strong><?php echo $ini['upload_max_filesize']; ?></li>
			   									<li><strong>upload_tmp_dir : </strong><?php echo $ini['upload_tmp_dir']; ?></li>
			   									<li><strong>post_max_size : </strong><?php echo $ini['post_max_size']; ?></li>
			   								</ul>
			   							</div>
			   						</li>
			   						<li>
			   							<div>
			   								<h3>Performances / Divers</h3>
			   								<ul>
			   									<li><strong>memory_limit : </strong><?php echo $ini['memory_limit']; ?></li>
			   									<li><strong>max_execution_time : </strong><?php echo $ini['max_execution_time']; ?></li>
			   									<li><strong>session.gc_maxlifetime : </strong>  <?php echo $ini['session.gc_maxlifetime']; ?></li>
			   									<li><strong>short_open_tag : </strong><?php $ini['short_open_tag'] == 1 ? print '<span style="color:red;">True</span>' : print 'False';; ?></li>
			   								</ul>
			   							</div>
			   						</li>	
			   						<br class="clear" />		   						
			   					</ul>
			   					<i>* Supprim&eacute; depuis la version 5.4 de php</i>
			   				</div>
			   			</li>
			   		</ul>
			   	</li>
			   	<li class="divider-vertical"></li>
			   	<li><a href="#">Configuration</a>
					<ul id="toolbar-config" class="tiitz-toolbar-info">
			   			<li>
			   				<div>
			   					<ul>
			   						<li><strong>Base de donn&eacute;es </strong>: <?php isset($conf['database']['dbname']) && !empty($conf['database']['dbname']) ? print $conf['database']['dbname'] : print 'none'; ?></li>
			   						<li><strong>Moteur de template </strong>: <?php isset($conf['template']) ? print $conf['template'] : print 'php'; ?></li>
			   						<li><strong>Environnement </strong>: <?php isset($conf['environnement']) ? print $conf['environnement']: print ''; ?></li>
			   						<li><strong>Langue </strong>: <?php isset($conf['language']) ? print $conf['language'] : print ''; ?></li>
			   						<li><strong>Route </strong>: <?php isset($conf['routingType']) ? print $conf['routingType'] : print ''; ?></li>
			   					</ul>
			   				</div>
			   			</li>
			   		</ul>
			   	</li>
			   	<li class="divider-vertical"></li>
			   	<li><a href="#"><?php isset($route['className']) ? print $route['className']:''; ?> : <?php isset($route['action']) ? print $route['action']:''; ?></a>
					<ul id="toolbar-file-controller" class="tiitz-toolbar-info">
			   			<li>
			   				<div>
			   					<ul>
			   						<li><strong>Controller </strong>: <?php isset($route['className']) ? print $route['className']:''; ?></li>
			   						<li><strong>Method </strong>: <?php isset($route['action']) ? print $route['action']:''; ?></li>
			   						<li><strong>Path </strong>: <?php isset($route['path']) ? print $route['path']:''; ?></li>
			   					</ul>
			   				</div>
			   			</li>
			   		</ul>
			   	</li>
			   	<li class="divider-vertical"></li>
			   	<li><a href="#">Logs Erreurs</a>
					<ul id="toolbar-log-error" class="tiitz-toolbar-info">
			   			<li>
			   					<?php for ($i=0; $i < count($errorArray); $i++) : ?> 
			   						<div <?php ($i%2 == 0) ? print "class='odd'" : print "class='even'" ?>>
			   							<p><strong>Date </strong>: <?php print $errorArray[$i]['date']; ?> | <strong>Num&eacute;ro erreur </strong>: <?php print $errorArray[$i]['type']; ?></p>
			   							<p><strong>Message </strong>: <?php print $errorArray[$i]['message']; ?></p>
			   							<p><strong>File </strong>: <?php print $errorArray[$i]['file']; ?> | <strong>Ligne </strong>: <?php print $errorArray[$i]['line']; ?></p>
			   						</div>		
			   					<?php endfor ?>
			   				
			   			</li>
			   		</ul>
			   	</li>
			   	<li><a href="<?php print WEB_PATH; ?>configTiitz/entityGenerator">Cr&eacute;er vos entit&eacute;es</a>
					<ul id="toolbar-load-entities" class="tiitz-toolbar-info">
			   			<li>
			   				
			   			</li>
			   		</ul>
			   	</li>
			</ul>
		</div>
	</div>
</footer>
