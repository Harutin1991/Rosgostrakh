<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/category">Category List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
  </ol>
</nav>
<h2>Add New Category</h2>
<form method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Category Name</label>
    <input type="text" class="form-control" name="category_name" placeholder="Category Name" />
  </div>
  <?php if(!empty($categories)):?>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Parent Category</label>
    <select class="form-control" name="parent_id">
		<option value="0">Please Choose</option>
		<?php foreach($categories as $category):?>
			<option value="<?=$category['id']?>"><?=$category['name']?></option>
		<?php endforeach;?>
    </select>
  </div>
  <?php endif;?>
  <button class="btn btn-primary pull-right" name="addCategory" type="submit">Add</button>
</form> 