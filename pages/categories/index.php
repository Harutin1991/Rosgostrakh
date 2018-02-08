<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Category List</li>
  </ol>
</nav>
<h2 class="pull-left">Categories List</h2>
<a href="/category/add/" class="btn btn-link pull-right" style="margin-top: 20px;">Add Category</a>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Category Name</th>
        <th>Parent Category</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($categories as $category):?>
      <tr>
        <td><?=$category['id']?></td>
        <td><?=$category['name']?></td>
        <td><?php if(!is_null($category['parent_id'])){ echo getCategoryParentName($category['parent_id']); }else{echo "";}?></td>
		<td>
			<a href="/category/edit/<?=$category['id']?>" class="btn btn-info">Edit</a>
			<a href="/category/delete/<?=$category['id']?>" class="btn btn-danger">Delete</a>
		</td>
      </tr>
	  <?php endforeach;?>
    </tbody>
  </table>