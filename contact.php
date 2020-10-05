<?php
require_once('functions/function.php');
include_once('config/session.php');
Session::init();
get_Header();
require_once('classes/UserContactUs.php');
?>

<?php
$contact = new Contactus();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$contactus = $contact->Contactus($_POST);
}
?>

<div class="main">
	<div class="content">
		<div class="support">
			<div class="support_desc">
				<h3>Live Support</h3>
				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
				<p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
			</div>
			<img src="web/images/contact.png" alt="" />
			<div class="clear"></div>
		</div>
		<div class="section group">
			<div class="col span_2_of_3">
				<div class="contact-form">
					<h2>Contact Us</h2>
					<?php
					if (isset($contactus)) {
						echo $contactus;
					}
					?>
					<form action="" method="post" enctype="multipart/form-data">
						<div>
							<span><label>NAME</label></span>
							<span><input type="text" name="name" value=""></span>
						</div>
						<div>
							<span><label>E-MAIL</label></span>
							<span><input style="padding: 8px;display: block;width: 98%;background: #fcfcfc;border: none;outline: none;color: #464646;font-size: 0.8125em;font-family: Arial, Helvetica, sans-serif;box-shadow: inset 0px 0px 3px #999;-webkit-box-shadow: inset 0px 0px 3px #999;-moz-box-shadow: inset 0px 0px 3px #999;-o-box-shadow: inset 0px 0px 3px #999;-webkit-appearance: none;" type="email" name="email" value=""></span>
						</div>
						<div>
							<span><label>MOBILE.NO</label></span>
							<span><input style="padding: 8px;display: block;width: 98%;background: #fcfcfc;border: none;outline: none;color: #464646;font-size: 0.8125em;font-family: Arial, Helvetica, sans-serif;box-shadow: inset 0px 0px 3px #999;-webkit-box-shadow: inset 0px 0px 3px #999;-moz-box-shadow: inset 0px 0px 3px #999;-o-box-shadow: inset 0px 0px 3px #999;-webkit-appearance: none;" type="number" name="mobile" value=""></span>
						</div>
						<div>
							<span><label>Message</label></span>
							<span><textarea name="message"> </textarea></span>
						</div>
						<div>
							<span><input name="submit" type="submit" value="SUBMIT"></span>
						</div>
					</form>
				</div>
			</div>
			<div class="col span_1_of_3">
				<div class="company_address">
					<h2>Company Information :</h2>
					<p>500 Lorem Ipsum Dolor Sit,</p>
					<p>22-56-2-9 Sit Amet, Lorem,</p>
					<p>USA</p>
					<p>Phone:(00) 222 666 444</p>
					<p>Fax: (000) 000 00 00 0</p>
					<p>Email: <span>info@mycompany.com</span></p>
					<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php

get_Footer()
?>