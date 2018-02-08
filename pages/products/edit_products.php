<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/product">Product List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Product <?=$productItem['product_name']?></li>
  </ol>
</nav>
<h2>Edit Product <?=$productItem['product_name']?></h2>
<form method="post" id="editProductForm">	
<input type="hidden" value="<?=$productItem['id']?>" name="product_id">
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Name</label>
    <input type="text" class="form-control" name="product_name" value="<?=$productItem['product_name']?>" placeholder="Product Name" required />
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Bought Price</label>
    <input type="text" class="form-control" name="bought_price" value="<?=$productItem['bought_price']?>" placeholder="Bought Price" required />
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Sell Price</label>
    <input type="text" class="form-control" name="sell_price" value="<?=$productItem['sell_price']?>" placeholder="Sell Price" required />
  </div>
	<?php if(!empty($categories)):?>
	  <div class="form-group">
		<label for="exampleFormControlSelect1">Category</label>
		<select class="form-control" name="category_id" required>
			<option value="0">Please Choose</option>
			<?php foreach($categories as $category):?>
				<option value="<?=$category['id']?>" <?php if($productItem['category_id'] == $category['id']):?>selected<?php endif;?> ><?=$category['name']?></option>
			<?php endforeach;?>
		</select>
	  </div>
	<?php endif;?>
  <div class="form-group">
    <label for="exampleFormControlInput1">Count</label>
    <input type="number" class="form-control" name="count" value="<?=$productItem['count']?>" placeholder="Product Count" required />
  </div>
  
  <div class="form-group">
		<label for="exampleFormControlInput1">Unit</label>
		<select class="form-control" name="unit" required>
			<option value="0">Please Choose</option>
			<option value="kg" <?php if($productItem['unit'] == 'kg'):?>selected<?php endif;?> >Kilo</option>
			<option value="m" <?php if($productItem['unit'] == 'm'):?>selected<?php endif;?> >Meter</option>
			<option value="piece" <?php if($productItem['unit'] == 'piece'):?>selected<?php endif;?> >Piece</option>
			<option value="l" <?php if($productItem['unit'] == 'l'):?>selected<?php endif;?> >Litr</option>
			<option value="m2" <?php if($productItem['unit'] == 'm2'):?>selected<?php endif;?> >Square</option>
		</select>
	  </div>
  <div class="form-group">
		<label for="exampleFormControlInput1">Currency</label>
		<select class="form-control" name="currency" required>
			<option value="0">Please Choose</option>
			<option value="AMD" <?php if($productItem['currency'] == 'AMD'):?>selected<?php endif;?>>AMD</option>
			<option value="EUR" <?php if($productItem['currency'] == 'EUR'):?>selected<?php endif;?>>EUR</option>
			<option value="USD" <?php if($productItem['currency'] == 'USD'):?>selected<?php endif;?>>USD</option>
			<option value="RUB" <?php if($productItem['currency'] == 'RUB'):?>selected<?php endif;?>>RUB</option>
		</select>
	  </div>
  
  <button class="btn btn-primary pull-right" name="editProduct" type="submit">Edit</button>
</form> 
<script>
$('#editProductForm').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) {
    // handle the invalid form...
  } else {
    // everything looks good!
  }
})
</script>