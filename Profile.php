<?php
require_once('functions/function.php');
include_once('config/session.php');
include_once('classes/LocalUser.php');
Session::init();
get_Header();
?>

<?php
$showProfile = new LocalUser();
$resProfile = $showProfile->showProfile();
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <table style="width:500px;margin:0 auto;border:1px solid #000;" class="tblone">
                <tr>
                    <td>name</td>
                    <td>:</td>
                    <td><?= $resProfile['local_name'] ?></td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>:</td>
                    <td><?= $resProfile['local_email'] ?></td>
                </tr>
                <tr>
                    <td>city</td>
                    <td>:</td>
                    <td><?= $resProfile['local_city'] ?></td>
                </tr>
                <tr>
                    <td>zip code</td>
                    <td>:</td>
                    <td><?= $resProfile['local_zipcode'] ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?= $resProfile['local_adress'] ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?= $resProfile['local_country'] ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?= $resProfile['local_phone'] ?></td>
                </tr>
            </table>
            <div style="width:500px;margin:0 auto;margin-top:30px">
                <a href="updateprofile.php"> <button type="submit" style="margin:0 auto">Update Profile</button></a>
            </div>
        </div>
    </div>
</div>
</div>

<?php

get_Footer()
?>