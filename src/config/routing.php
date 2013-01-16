<?php
	$tzRoute = array(

		"main_show" => array(
						"pattern" => '/{page}/',
						"controller" => "main:show",
						"requirements" => array(
											"page" => "int"
												)
							),

		"blog_show" => array(
						"pattern" => "/blog/",
						"controller" => "blog:show",
							),
	
				);