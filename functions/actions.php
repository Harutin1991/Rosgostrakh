<?php
if(isset($_GET['productId']) && isset($_GET['action']) && $_GET['action'] =="delete"){
	removeItem($_GET['productId'],PRODUCT);
	header("Location://".$_SERVER['SERVER_NAME']."/product/");exit();
}
if(isset($_GET['categoryId']) && isset($_GET['action']) && $_GET['action'] =="delete"){
	removeItem($_GET['categoryId'],CATEGORY);
	header("Location://".$_SERVER['SERVER_NAME']."/category/");exit();
}
if(isset($_GET['action']) && $_GET['action'] =="export"){
	exportProduct();
	header("Location://".$_SERVER['SERVER_NAME']."/product/");exit();
}

if(isset($_GET['action']) && $_GET['action'] =="exportOut"){
	exportOutProduct();
	header("Location://".$_SERVER['SERVER_NAME']."/product/");exit();
}
if(isset($_GET['action']) && $_GET['action'] =="edit" && $_GET['show']=="category"){
	if(isCategoryItemExist($_GET['categoryId'])){
		$categoryItem = getCategoryItem($_GET['categoryId']);
	}else{
		header("Location://".$_SERVER['SERVER_NAME']."/category/faild");exit();
	}
	
}
if(isset($_GET['action']) && $_GET['action'] =="edit" && $_GET['show']=="product"){
	if(isProductItemExist($_GET['productId'])){
		$productItem = getProductItem($_GET['productId']);
	}else{
		header("Location://".$_SERVER['SERVER_NAME']."/product/faild");exit();
	}
}
if(isset($_POST['addCategory'])){
	$insertData = array('name'=>$_POST['category_name']);
	if(isset($_POST['parent_id'])){
		$insertData['parent_id'] = $_POST['parent_id'];
	}else{
		$insertData['parent_id'] = NULL;
	}
	if(addCategory($insertData)){
		header("Location://".$_SERVER['SERVER_NAME']."/category/");exit();
	}
}

if(isset($_POST['addProduct'])){
	$insertData = $_POST;
	if(addProduct($insertData)){
		header("Location://".$_SERVER['SERVER_NAME']."/product/");exit();
	}
}

if(isset($_POST['editProduct'])){
	$updatetData = $_POST;
	if(editProduct($_POST['product_id'],$updatetData)){
		header("Location://".$_SERVER['SERVER_NAME']."/product/");exit();
	}
}

if(isset($_POST['editCategory'])){
	$updatetData = array('name'=>$_POST['name']);
	if(isset($_POST['parent_id'])){
		$updatetData['parent_id'] = $_POST['parent_id'];
	}else{
		$updatetData['parent_id'] = NULL;
	}
	if(editCategory($_POST['category_id'],$updatetData)){
		header("Location://".$_SERVER['SERVER_NAME']."/category/");exit();
	}
}
?>