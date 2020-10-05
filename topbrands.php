<?php
require_once('functions/function.php');
include_once('config/session.php');
Session::init();
get_Header();
require_once('classes/Allproducts.php');
?>

<?php
$Product = new Allproducts()
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Acer</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			foreach ($Product->AserBrandProduct() as $key => $value) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-3.html"><img src="admin/<?= $value['product_image'] ?>" alt="" /></a>
					<h2>
						<?= $value['productname'] ?>
					</h2>
					<p><span class="price">$<?= $value['product_price'] ?></span></p>
					<div class="button"><span><a href="preview.php?id=<?= $value['product_id'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Samsung</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			foreach ($Product->sumsangproduct() as $key => $value) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-3.html"><img src="admin/<?= $value['product_image'] ?>" alt="" /></a>
					<h2>
						<?= $value['productname'] ?>
					</h2>
					<p><span class="price">$<?= $value['product_price'] ?></span></p>
					<div class="button"><span><a href="preview.php?id=<?= $value['product_id'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Canon</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			foreach ($Product->cannonProduct() as $key => $value) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-3.html"><img src="admin/<?= $value['product_image'] ?>" alt="" /></a>
					<h2>
						<?= $value['productname'] ?>
					</h2>
					<p><span class="price">$<?= $value['product_price'] ?></span></p>
					<div class="button"><span><a href="preview.php?id=<?= $value['product_id'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
</div>
<?php

get_Footer()
?>