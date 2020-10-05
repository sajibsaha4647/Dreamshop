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

<?php


$id = $_GET['id'];
$result = $Product->showProductByCategory($id);


?>


<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			if (!empty($result)) {
				foreach ($result as $key => $value) {
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
			} else {
				?>
				<p><span style="margin: 0 auto;text-align:center" class="price">No Items there</span></p>
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