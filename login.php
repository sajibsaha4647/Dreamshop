<?php
require_once('functions/function.php');
require_once('classes/LocalUser.php');
include_once('config/session.php');
Session::init();
get_Header();
$Local = new LocalUser();

$checkLogin = Session::get('CustomerLogin');

if ($checkLogin == true) {
	header("location: Payment.php");
} else {
}


?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$login = $Local->CustomerLogin($_POST);
}

?>


<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<?php
			if (isset($login)) {
				echo $login;
			}
			?>
			<form action="" method="POST" id="member">
				<input name="email" type="text" placeholder="email" class="field">
				<input name="password" type="password" placeholder="password" class="field">
				<div class="buttons">
					<div><button name="login" class="grey">Sign In</button></div>
					<!-- <input type="submit" name="login" class="grey" Value="Sign In" /> -->
				</div>
			</form>
			<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
		</div>

		<?php

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Register'])) {
			$customer = $Local->insert($_POST);
		}

		?>


		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($customer)) {
				echo $customer;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="name">
								</div>

								<div>
									<input type="text" name="city" placeholder="city">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="zipcode">
								</div>
								<div>
									<input style="font-size: 12px;color: #B3B1B1;padding: 8px;outline: none;margin: 5px 0;width: 340px;" type="email" name="email" placeholder="email" require>
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="address">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Aruba">Aruba</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>

									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="phone">
								</div>

								<div>
									<input type="text" name="password" placeholder="password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><button type="Register" name="Register" class="grey">Create Account</button></div>
					<!-- <input type="submit" name="Register" class="grey" Value="Create Account" /> -->
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<?php

get_Footer()
?>