<?php

require_once('functions/function.php');
require_once('classes/Allproducts.php');
require_once('classes/productBrand.php');
include_once('config/session.php');
Session::init();
get_Header();

?>

<?php
$productTable = new Allproducts();
$BrandName = new Productbrand();
// echo session_id();
?>

<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$BrandData = $productTable->GetBrandProduct();
			if ($BrandData) {
				while ($Brandres = $BrandData->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="preview.php"> <img src="admin/<?= $Brandres['product_image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?= $Brandres['brand_name'] ?></h2>
							<p><?= substr($Brandres['product_body'], 0, 50) ?></p>
							<div class="button"><span><a href="preview.php?action=preview&id=<?= $Brandres['product_id'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<li><img src="images/1.jpg" alt="" /></li>
					<li><img src="images/2.jpg" alt="" /></li>
					<li><img src="images/3.jpg" alt="" /></li>
					<li><img src="images/4.jpg" alt="" /></li>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$pdata = $productTable->GetFeatureProduct();
			if ($pdata) {
				while ($res = $pdata->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.php"><img src="admin/<?= $res['product_image'] ?>" alt="" /></a>
						<h2><?= $res['productname'] ?> </h2>
						<p><?= substr($res['product_body'], 0, 50) ?></p>
						<p><span class="price">$<?= $res['product_price'] ?></span></p>
						<div class="button"><span><a href="preview.php?action=preview&id=<?= $res['product_id'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$pdata = $productTable->GetNewProduct();
			if ($pdata) {
				while ($res = $pdata->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.php"><img src="admin/<?= $res['product_image'] ?>" alt="" /></a>
						<h2><?= $res['productname'] ?></h2>
						<p><span class="price">$<?= $res['product_price'] ?></span></p>
						<div class="button"><span><a href="preview.php?action=preview&id=<?= $res['product_id'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
</div>

<?php

get_Footer()
?>