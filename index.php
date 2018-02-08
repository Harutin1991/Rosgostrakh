<?php
ERROR_REPORTING(2000);
/* DB Tables */
define("CATEGORY", "categories");
define("PRODUCT", "products");
define("LOG", "stock_log");

/* FUNCTIONS */
include('functions/connection.php');
include('functions/functions.php');
include('functions/getUrl.php');
include('functions/actions.php');
/* FUNCTIONS end */

/* INCLUDES */
include('includes/header.php');
include('includes/content.php');
include('includes/footer.php');
/* INCLUDES end */
mysql_close();
?>