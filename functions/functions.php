<?php
$categories = [];
$products = [];
$expenses = 0;
$profit = 0;
/* Currency List */
$currencyList = ['AMD'=>1,'EUR'=>590,'USD'=>481,'RUB'=>8];

function getProductList(){
	$productArray = [];
	$prodQuery = mysql_query("SELECT * FROM ".PRODUCT);
	while ($rows = mysql_fetch_assoc($prodQuery)) {
		$productArray[] = $rows;
	}
	return $productArray;
}

function getCategoryList(){
	$categoryArray = [];
	$catQuery = mysql_query("SELECT * FROM ".CATEGORY);
	while ($rows = mysql_fetch_assoc($catQuery)) {
		$categoryArray[] = $rows;
	}
	return $categoryArray;
}

function getCategoryParentName($category_id){
	$parentCategoryName = "";
	$parentCatQuery = mysql_query("SELECT * FROM ".CATEGORY." WHERE id=".$category_id);
	while ($rows = mysql_fetch_assoc($parentCatQuery)) {
		$parentCategoryName = $rows['name'];
	}
	return $parentCategoryName;
}

function getProductCategory($category_id){
	$categoryName = "";
	$catQuery = mysql_query("SELECT * FROM ".CATEGORY." WHERE id=".$category_id);
	while ($rows = mysql_fetch_assoc($catQuery)) {
		$categoryName = $rows['name'];
	}
	return $categoryName;
}
function removeItem($itemId,$table){
	$remove = mysql_query("DELETE FROM $table WHERE id = $itemId");
	return $remove;
}
function addProduct($data){
	$insert = mysql_query("INSERT INTO ".PRODUCT." (product_name, bought_price,sell_price,count,category_id,unit,currency)
							VALUES ('".$data['product_name']."', '".$data['bought_price']."', '".$data['sell_price']."', '".$data['count']."', '".$data['category_id']."', '".$data['unit']."', '".$data['currency']."')");
	return $insert;
}
function addCategory($data){
	if(!is_null($data['parent_id']) && $data['parent_id']){
		$insert = mysql_query("INSERT INTO ".CATEGORY." (name, parent_id)
							VALUES ('".$data['name']."', '".$data['parent_id']."')");
	}else{
		$insert = mysql_query("INSERT INTO ".CATEGORY." (name)
							VALUES ('".$data['name']."')");
	}
	return $insert;
}
function isCategoryItemExist($category_id){
	$categoryItemQuery = mysql_query("SELECT * FROM ".CATEGORY." WHERE id=".$category_id);
	$rowCount = mysql_num_rows($categoryItemQuery);
	if($rowCount > 0){
		return true;
	}
	return false;
}
function isProductItemExist($product_id){
	$productItemQuery = mysql_query("SELECT * FROM ".PRODUCT." WHERE id=".$product_id);
	$rowCount = mysql_num_rows($productItemQuery);
	if($rowCount > 0){
		return true;
	}
	return false;
}
function getCategoryItem($category_id){
	$categoryItem = [];
	$categoryItemQuery = mysql_query("SELECT * FROM ".CATEGORY." WHERE id=".$category_id);
	while ($rows = mysql_fetch_assoc($categoryItemQuery)) {
		$categoryItem[] = $rows;
	}
	if(empty($categoryItem)){
		return false;
	}
	return $categoryItem[0];
}
function getProductItem($product_id){
	$productItem = [];
	$productItemQuery = mysql_query("SELECT * FROM ".PRODUCT." WHERE id=".$product_id);
	while ($rows = mysql_fetch_assoc($productItemQuery)) {
		$productItem[] = $rows;
	}
	if(empty($productItem)){
		return false;
	}
	return $productItem[0];
}
function editProduct($product_id,$data){
	$productCountQuery = mysql_query("SELECT count FROM ".PRODUCT." WHERE id=".$product_id);
	list($productCount) = mysql_fetch_array($productCountQuery, MYSQL_NUM);
	if($productCount < $data['count']){
		$diffCount = $data['count'] - $productCount;
		$insert = mysql_query("INSERT INTO ".LOG." (product_id, product_count,log_type)
							VALUES ('".$product_id."', '".$diffCount."','1')");
	}elseif($productCount > $data['count']){
		$diffCount = $productCount - $data['count'];
		$insert = mysql_query("INSERT INTO ".LOG." (product_id, product_count,log_type)
							VALUES ('".$product_id."', '".$diffCount."','0')");
	}
	if($data['count'] == 0){
		$update = mysql_query("UPDATE ".PRODUCT." SET 	product_name='".$data['product_name']."',
													bought_price='".$data['bought_price']."', 
													sell_price='".$data['sell_price']."', 
													count='".$data['count']."', 
													category_id='".$data['category_id']."', 
													unit='".$data['unit']."', 
													currency='".$data['currency']."',
													in_stock = 0
							WHERE id=".$product_id);
	}else{
		$update = mysql_query("UPDATE ".PRODUCT." SET 	product_name='".$data['product_name']."',
													bought_price='".$data['bought_price']."', 
													sell_price='".$data['sell_price']."', 
													count='".$data['count']."', 
													category_id='".$data['category_id']."', 
													unit='".$data['unit']."', 
													currency='".$data['currency']."'
							WHERE id=".$product_id);
	}
	
		
	return $update;
}
function editCategory($category_id,$data){
	if(!is_null($data['parent_id']) && $data['parent_id']){
		$update = mysql_query("UPDATE ".CATEGORY." SET name='".$data['name']."',parent_id='".$data['parent_id']."' WHERE id=".$category_id);
	}else{
		$update = mysql_query("UPDATE ".CATEGORY." SET name='".$data['name']."' WHERE id=".$category_id);
	}
	return $update;
}

function exportProduct(){
	$filename = "productList";
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=$filename.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
	$sep = "\t";
	$result = mysql_query("SELECT * FROM ".PRODUCT);
	echo "Product Name\t"; echo "Category Name\t"; echo "Bought Price\t"; echo "Sell Price\t"; echo "Count\t"; 
	$headerInfo = ['product_name'=>'Product Name','category_id'=>'Category Name','bought_price'=>'Bought Price','sell_price'=>'Sell Price','count'=>'Count'];
	print("\n");  
    while($row = mysql_fetch_assoc($result))
    {
        $output_str = "";
		$output_str .= $row['product_name'].$sep;
		$output_str .= getProductCategory($row['category_id']).$sep;
		$output_str .= $row['bought_price'].' '.$row['currency'].$sep;
		$output_str .= $row['sell_price'].' '.$row['currency'].$sep;
		$output_str .= $row['count'].' '.$row['unit'].$sep;
        $output_str = str_replace($sep."$", "", $output_str);
        $output_str = preg_replace("/\r\n|\n\r|\n|\r/", " ", $output_str);
        $output_str .= "\t";
        print(trim($output_str));
        print "\n";
    } 
	exit();
}
function exportOutProduct(){
	$filename = "outProductList";
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=$filename.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
	$sep = "\t";
	$resultLog = mysql_query("SELECT product_id,SUM(product_count) as outCount FROM ".LOG." WHERE log_type=0 group by product_id");
	$productutInfo = [];
	$productutOutPrice = [];
	while($row = mysql_fetch_assoc($resultLog))
    {
		$resultProduct = mysql_query("SELECT id,product_name,bought_price,sell_price,category_id,currency,unit FROM ".PRODUCT." WHERE id=".$row['product_id']);
		$productutOutPrice[$row['product_id']] = $row['outCount'];
		while($row1 = mysql_fetch_assoc($resultProduct))
		{
			$productutInfo[] = $row1;
		}
	}

	echo "Product Name\t"; echo "Category Name\t"; echo "Bought Price\t"; echo "Sell Price\t"; echo "Count\t"; 
	$headerInfo = ['product_name'=>'Product Name','category_id'=>'Category Name','bought_price'=>'Bought Price','sell_price'=>'Sell Price','count'=>'Count'];
	print("\n");  
	foreach($productutInfo as $info)
    {
        $output_str = "";
		$output_str .= $info['product_name'].$sep;
		$output_str .= getProductCategory($info['category_id']).$sep;
		$output_str .= $info['bought_price'].' '.$info['currency'].$sep;
		$output_str .= $info['sell_price'].' '.$info['currency'].$sep;
		$output_str .= $productutOutPrice[$info['id']].' '.$row['unit'].$sep;
        $output_str = str_replace($sep."$", "", $output_str);
        $output_str = preg_replace("/\r\n|\n\r|\n|\r/", " ", $output_str);
        $output_str .= "\t";
        print(trim($output_str));
        print "\n";
    } 
	exit();
}

function getLogInfo(){
	$logInfo = [];
	$result = mysql_query("SELECT * FROM ".LOG." ORDER BY date");
	while($row = mysql_fetch_assoc($result))
    {
		$logInfo[$row['product_id']][] = $row;
	}
	return $logInfo;
}

function getProductInfo($product_id){
	$sellPrice = 0;
	$sellPriceQuery = mysql_query("SELECT sell_price,bought_price,unit,currency FROM ".PRODUCT." WHERE id=".$product_id);
	list($sellPrice,$bought_price,$unit,$currency) = mysql_fetch_array($sellPriceQuery, MYSQL_NUM);
	return ['sellPrice'=>$sellPrice,'bought_price'=>$bought_price,'unit'=>$unit,'currency'=>$currency];
}
function countProfitAndExpenses($currencyList){
	$logInfo = getLogInfo();
	$profitCount = 0;
	$expensesCount = 0;
	
	foreach($logInfo as $key=>$log){
		$sellPrice = getProductInfo($key)['sellPrice'];
		$boughtPrice = getProductInfo($key)['bought_price'];
		$unit = getProductInfo($key)['unit'];
		$currency = getProductInfo($key)['currency'];
		foreach($log as $product){
			if($product['log_type']){
				$expensesCount += $boughtPrice * $product['product_count'] * $currencyList[$currency];
			}else{
				$profitCount += $sellPrice * $product['product_count'] * $currencyList[$currency];
			}
		}
	}
	$profit = $profitCount - $expensesCount;
	$budgeInfo = ['profit'=>$profit,'expenses'=>$expensesCount];
	return $budgeInfo;
}
$budge = countProfitAndExpenses($currencyList);
$expenses = $budge['expenses'];
$profit = $budge['profit'];
$categories = getCategoryList();
$products = getProductList();
?>