<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Product List</li>
  </ol>
</nav>
<h2 class="pull-left">Product List</h2>
<a href="/product/add/" class="btn btn-link pull-right" style="margin-top: 20px;">Add Product</a>
<a href="/product/export/" class="btn btn-link pull-right" style="margin-top: 20px;">Export Products List<img src="/public/images/excel.jpg" style="width: 25px;"></a>
<a href="/product/exportOut/" class="btn btn-link pull-right" style="margin-top: 20px;">Download Product Output List<img src="/public/images/excel.jpg" style="width: 25px;"></a>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Bought Price</th>
        <th>Sell Price</th>
        <th>Product Count</th>
        <th>Product Category</th>
		<th>In Stock</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($products as $product):?>
      <tr>
        <td><?=$product['id']?></td>
        <td><?=$product['product_name']?></td>
        <td><?=number_format($product['bought_price'], 2, '.', ' ').' '.$product['currency']?></td>
        <td><?=number_format($product['sell_price'], 2, '.', ' ').' '.$product['currency']?></td>
        <td><?=$product['count'].' '.$product['unit']?></td>
        <td><?php echo getProductCategory($product['category_id']);?></td>
         <td><?php if($product['in_stock']){ echo "<p class='text-success'>In Stock</p>"; }else{ echo "<p class='text-warning'>Out Stock</p>";  }?></td>
		<td>
			<a href="/product/edit/<?=$product['id']?>" class="btn btn-info">Edit</a>
			<a href="/product/delete/<?=$product['id']?>" class="btn btn-danger">Delete</a>
		</td>
      </tr>
	  <?php endforeach;?>
    </tbody>
  </table>