<div class="container">
<?php 
if(isset($action) && $action != ""){
	include('pages/'.$show.'/'.$action.'_'.$show.'.php'); 
}else{
	include('pages/'.$show.'/index.php'); 
}
?>
</div>