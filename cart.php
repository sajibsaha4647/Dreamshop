<?php
error_reporting(0);
require_once('functions/function.php');
include_once('config/database.php');
require_once('classes/UserCart.php');
include_once('config/session.php');
Session::init();
get_Header();
$db = new Database();
$addtocart = new UserCart();
$sessionid = session_id();
?>



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cart = $addtocart->UpdateCard($_POST);
}
?>

<?php
if (isset($_GET['action'])) {
	$id = $_GET['id'];
	$delete = $addtocart->DeleteCart($id);
}
?>
<?php
if (!isset($_GET['id'])) {
	echo '<meta http-equiv="refresh" content="0; url=?id=index.php" /> ';
}
?>


<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>

				<?php
				if (isset($delete)) {
					echo $delete;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php

					if ($cart = Session::get("cart")[$sessionid]) {
						$i = 0;
						$qty = 0;
						$sum = 0;
						foreach ($cart as $key => $result) {
							$i++;
							// var_dump($result);
					?>
							<tr>
								<td><?= $result['product_name'] ?></td>
								<td><img src="admin/<?= $result['product_image'] ?>" alt="" /></td>
								<td>Tk. <?= $result['product_price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="product_quantity" value="<?= $result['product_quantity'] ?>" />
										<input type="hidden" name="product_id" value="<?= $result['product_id'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td>Tk. <?= $total = ($result['product_price']) * ($result['product_quantity']) ?></td>
								<td><a onclick="return confirm('are you sure!')" href="cart.php?action&id=<?= $result['product_id'] ?>">X</a></td>



							</tr>
					<?php
							$qty = $qty + (int)$result['product_quantity'];
							$sum = $sum + $total;
							$data =  Session::set('Qyt', $qty);
							// print_r($totalqyt);
						}
					}

					?>
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<?php
					if (!empty($cart)) {
					?>
						<tr>
							<th>Sub Total : </th>
							<td>$<?= $sum ?>
							</td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>15%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td>$
								<?php
								$vat =  ($sum * 0.10);
								$res = $sum + $vat;
								echo $res
								?>
							</td>
						</tr>
					<?php
					} else {
					?>
						<p class="aligncenter">Your cart Empty Shop Now</p>
					<?php } ?>
				</table>
			</div>
			<div class="shopping">
				<?php
				if (!empty($cart)) {
				?>
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
					<div class="shopright">
						<a href="login.php"> <img src="images/check.png" alt="" /></a>
					</div>
				<?php
				}
				?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>

<?php

get_Footer()
?>