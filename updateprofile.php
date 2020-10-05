<?php
require_once('functions/function.php');
include_once('config/session.php');
Session::init();
get_Header();

?>

<?php
$showProfile = new LocalUser();
$resProfile = $showProfile->showProfile();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateProfile = $showProfile->updateProfile($_POST);
}

?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="col span_2_of_3">
                <div class="contact-form">
                    <h2>Update Profile</h2>
                    <?php
                    if (isset($updateProfile)) {
                        echo $updateProfile;
                    }
                    ?>
                    <form action="" method="post">
                        <div>
                            <span><label>name</label></span>
                            <span><input type="text" name="local_name" value="<?= $resProfile['local_name'] ?>"></span>
                        </div>
                        <div>
                            <span><label>email</label></span>
                            <span><input disabled type="text" name="local_email" value="<?= $resProfile['local_email'] ?>"></span>
                        </div>
                        <div>
                            <span><label>city</label></span>
                            <span><input type="text" name="local_city" value="<?= $resProfile['local_city'] ?>"></span>
                        </div>
                        <div>
                            <span><label>zip code</label></span>
                            <span><input type="text" name="local_zipcode" value="<?= $resProfile['local_zipcode'] ?>"></span>
                        </div>
                        <div>
                            <span><label>Address</label></span>
                            <span><input type="text" name="local_adress" value="<?= $resProfile['local_adress'] ?>"></span>
                        </div>
                        <div>
                            <span><label>Country</label></span>
                            <span><input type="text" name="local_country" value="<?= $resProfile['local_country'] ?>"></span>
                        </div>
                        <div>
                            <span><label>Phone</label></span>
                            <span><input type="text" name="local_phone" value="<?= $resProfile['local_phone'] ?>"></span>
                        </div>
                        <div>
                            <span><input name="update" type="submit" value="SUBMIT"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php

get_Footer()
?>