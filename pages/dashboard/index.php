<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
  </ol>
</nav>
<h1>Dashboard</h1>
<div class="row">
	<div class="col-sm-6">
		<h2>Expenses : <?php echo $expenses." AMD"?></h2>
	</div>
	<div class="col-sm-6">
		<h2>Profit : <?php echo $profit." AMD"?></h2>
	</div>
</div>
<input type="hidden" value="<?=$expenses?>" id="expenses">
<input type="hidden" value="<?=$profit?>" id="profit">
<div id="dashboardGraph"></div>