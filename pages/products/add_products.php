<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/product">Product List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
  </ol>
</nav>
<h2>Add New Product</h2>
<form method="post" id="addProductForm">
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Name</label>
    <input type="text" class="form-control" name="product_name" placeholder="Product Name" required />
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Bought Price</label>
    <input type="text" class="form-control" name="bought_price" placeholder="Bought Price" required />
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Sell Price</label>
    <input type="text" class="form-control" name="sell_price" placeholder="Sell Price" required />
  </div>
	<?php if(!empty($categories)):?>
	  <div class="form-group">
		<label for="exampleFormControlSelect1">Category</label>
		<select class="form-control" name="category_id" required>
			<option value="0">Please Choose</option>
			<?php foreach($categories as $category):?>
				<option value="<?=$category['id']?>"><?=$category['name']?></option>
			<?php endforeach;?>
		</select>
	  </div>
	<?php endif;?>
  <div class="form-group">
    <label for="exampleFormControlInput1">Count</label>
    <input type="number" class="form-control" name="count" placeholder="Product Count" required />
  </div>
	<div class="form-group">
		<label for="exampleFormControlInput1">Unit</label>
		<select class="form-control" name="unit" required>
			<option value="0">Please Choose</option>
			<option value="kg">Kilo</option>
			<option value="m">Meter</option>
			<option value="piece">Piece</option>
			<option value="lt">Litr</option>
			<option value="m2">Square</option>
		</select>
	  </div>
  <div class="form-group">
		<label for="exampleFormControlInput1">Currency</label>
		<select class="form-control" name="currency" required>
			<option value="0">Please Choose</option>
			<option value="AMD">AMD</option>
			<option value="EUR">EUR</option>
			<option value="USD">USD</option>
			<option value="RUB">RUB</option>
		</select>
	  </div>
  <button class="btn btn-primary pull-right" name="addProduct" type="submit">Add</button>
</form> 