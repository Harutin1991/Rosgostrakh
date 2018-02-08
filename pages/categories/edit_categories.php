<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/category">Category List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Category <?=$categoryItem['name']?></li>
  </ol>
</nav>
<h2>Edit Category <?=$categoryItem['name']?></h2>
<form method="POST">
	<input type="hidden" value="<?=$categoryItem['id']?>" name="category_id">
  <div class="form-group">
    <label for="exampleFormControlInput1">Category Name</label>
    <input type="text" class="form-control" value="<?=$categoryItem['name']?>" placeholder="Category Name" name="name">
  </div>
  <div class="form-group"> 
    <label for="exampleFormControlSelect1">Parent Category</label>
    <select class="form-control" name="parent_id">
		<option value="0">Please Choose</option>
		<?php foreach($categories as $category):?>
		<?php if($category['id'] != $categoryItem['id']):?>
		<option value="<?=$category['id']?>" <?php if($categoryItem['parent_id'] == $category['id']):?>selected<?php endif;?> ><?=$category['name']?></option>
		<?php endif;?> 
		<?php endforeach;?>
    </select>
  </div>
  <button class="btn btn-primary pull-right" name="editCategory" type="submit">Edit</button>
</form> 