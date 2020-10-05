<?php

require_once('functions/function.php');
require_once('classes/productCategory.php');
require_once('classes/Allproducts.php');
require_once('classes/UserCart.php');

include_once('config/session.php');

Session::init();
get_Header();
$productCat = new ProductCategory();
$productTable = new Allproducts();
$addtocart = new UserCart();





$id = $_GET['id'];
$result = $productTable->Productdetails($id);



?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$carts = $addtocart->Addtocard($_POST, $id);
}
?>



<div class="main">
	<div class="content">
		<div class="section group">
			<div class="cont-desc span_1_of_2">
				<?php
				if (isset($carts)) {
					echo $carts;
				}
				?>
				<div class="grid images_3_of_2">
					<img src="admin/<?= $result['product_image'] ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?= $result['productname'] ?> </h2>
					<div class="price">
						<p>Price: <span>$<?= $result['product_price'] ?></span></p>
						<p>Category: <span><?= $result['brand_name'] ?></span></p>
						<p>Brand:<span><?= $result['cat_name'] ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="product_quantity" value="1" />
							<a href="?id=<?= $result['product_id'] ?>"><input type="submit" class="buysubmit" name="submit" value="Buy Now" /></a>
						</form>
					</div>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<p><?= $result['product_body'] ?></p>
				</div>
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php
					$prodCat = $productCat->showAllCategory();
					if ($prodCat) {
						while ($rescat = $prodCat->fetch_assoc()) {
					?>
							<li><a href="productbycat.php?id=<?= $rescat['cat_id'] ?>"><?= $rescat['cat_name'] ?></a></li>
					<?php
						}
					}
					?>
				</ul>

			</div>
		</div>
	</div>
</div>
<?php

get_Footer()
?>