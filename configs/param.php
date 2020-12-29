<?php

define("__DIR_LIB", "library");

# Libraries for module user
define("LIB_CORE_DBO", 			"Core:vsc_pdo");
define("LIB_CORE_IMAGE", 		"Core:vsc_image");
define("LIB_CORE_STRING", 		"Core:vsc_string");
define("LIB_CORE_LANG", 		"Core:vsc_languages");
define("LIB_CORE_PAGINATION", 	"Core:vsc_pagination");
define("LIB_CORE_SITEMAPXML", 	"Core:vsc_sitemapxml");
define("LIB_CORE_API", 	        "Core:vsc_api");

define("LIB_HELP_HTMLPARSE", 	"Help:simple_html_dom");
define("LIB_HELP_PHPMAILER", 	"Help:PHPMailer:Autoload");
define("LIB_HELP_FACEBOOK", 	"Help:Facebook:autoload");
define("LIB_HELP_HTMLDOM",   	"Help:PhpSimple:HtmlDomParser");

define("LIB_DBO_USER", 			"Dbo:DboUser");
define("LIB_DBO_POST", 			"Dbo:DboPosts");
define("LIB_DBO_HELP", 			"Dbo:DboHelp");
define("LIB_DBO_TAXONOMY", 		"Dbo:DboTaxonomy");
define("LIB_DBO_MEDIA", 		"Dbo:DboMedia");
define("LIB_DBO_MENU",          "Dbo:DboMenu");
define("LIB_DBO_AI", 			"Dbo:DboAi");
define("LIB_DBO_PAGE", 			"Dbo:DboPage");
define("LIB_DBO_SERVICE", 		"Dbo:DboService");
define("LIB_DBO_PRODUCT", 		"Dbo:DboProduct");
define("LIB_DBO_JOB", 			"Dbo:DboJob");

define("PRODUCT_GRID", 		"../product/search.tpl");
define("PRODUCT_LIST", 		"../product/search_list.tpl");

define("URL_ERROR_PAGE", "./errorpage");
// define('URL_API_MAIN', 'http://'.$_SERVER['HTTP_HOST'].'/projects/daisan.api/');
define('URL_API_MAIN', 'http://product.ds_api.hodine.com/');
