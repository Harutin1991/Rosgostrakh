<?php
$show = empty($_GET['show'])?"":$_GET['show'];
$action = empty($_GET['action'])?"":$_GET['action'];
switch($show)
{
	case 'product': $show = "products"; break;
	case 'category': $show = "categories"; break;
	case 'documents': $show = "documents"; break;
	case 'help': $show = "help"; break;
	default: $show = "dashboard"; break;
}
?>