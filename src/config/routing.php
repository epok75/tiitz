<?php
	$tzRoute = array(

		"show_user" => array(
						"pattern" => '/{user_name}/{id}/{link}/',
						"controller" => "home:show",
						"requirements" => array(
											"user_name" => "string",
											"id" => "int",
											"link" => "\d+",
											"_method" => "POST"
												)
							),

		"home_show" => array(
						"pattern" => "/{page}/",
						"controller" => "home:show",
						"requirements" => array(
											"page" => "int",
											"ajax" => "true"
												)
							),
	
				);