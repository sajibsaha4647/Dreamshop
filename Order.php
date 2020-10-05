<?php
require_once('functions/function.php');
include_once('config/database.php');
require_once('classes/UserCart.php');
require_once('classes/LocalUser.php');
include_once('config/session.php');
Session::init();
get_Header();
$db = new Database();
$addtocart = new UserCart();
$local = new LocalUser();
$resProfile = $local->showProfile();
?>


<?php

if (isset($_GET['action']) && $_GET['action'] == 'order') {
    $successOrder = $local->GetinsertUserOrder();
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
                <div style="margin-bottom:30px">
                    <?php
                    if (isset($successOrder)) {
                        echo $successOrder;
                    }
                    ?>
                    <table style="width:46%;border:1px solid #000;float:left;margin-bottom:30px;margin-right:30px">
                        <tr style="background-color:#ddd">
                            <th width="20% ;font-size:16px">Product Name</th>
                            <th width="15% ;font-size:16px">Price</th>
                            <th width="25% ;font-size:16px">Quantity</th>
                            <th width="20% ;font-size:16px">Total Price</th>
                        </tr>
                        <?php
                        $sessionid = session_id();
                        if ($cart = Session::get("cart")[$sessionid]) {
                            $i = 0;
                            $qty = 0;
                            $sum = 0;
                            foreach ($cart as $key => $value) {
                                $i++
                        ?>
                                <tr>
                                    <td style="text-align:center;padding-top:10px"><?= $value['product_name'] ?></td>
                                    <td style="text-align:center;padding-top:10px"><?= $value['product_price'] ?></td>
                                    <td style="text-align:center;padding-top:10px"><?= $value['product_quantity'] ?></td>
                                    <td style="text-align:center;padding-top:10px"><?= $total = ($value['product_price']) * ($value['product_quantity'])  ?></td>
                                </tr>
                        <?php
                                $qty = $qty + $value['product_quantity'];
                                $sum = $sum + $total;
                            }
                        }
                        ?>
                    </table>
                    <div class="division" style="width:46%;float:left">
                        <table style="border:1px solid #000;" class="tblone">
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
                    </div>
                </div>
                <div style="width:300px;margin-top:40px">
                    <?php


                    ?>
                    <table style="width:300px;border:1px solid #000">
                        <tr style="margin-top:20px">
                            <td style="text-align:center;padding-top:10px">Subtotal</td>
                            <td style="text-align:center;padding-top:10px">:</td>
                            <td style="text-align:center;padding-top:10px"><?= $sum ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;padding-top:10px">Vat</td>
                            <td style="text-align:center;padding-top:10px">:</td>
                            <td style="text-align:center;padding-top:10px">15%</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;padding-top:10px">Quentity</td>
                            <td style="text-align:center;padding-top:10px">:</td>
                            <td style="text-align:center;padding-top:10px"><?php echo $qty ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;padding-top:10px">Grand total</td>
                            <td style="text-align:center;padding-top:10px">:</td>
                            <td style="text-align:center;padding-top:10px">$
                                <?php
                                $vat =  ($sum * 0.10);
                                $res = $sum + $vat;
                                echo $res
                                ?></td>
                        </tr>
                    </table>
                    <?php

                    ?>
                </div>
                <div style="margin-top:50px">
                    <a href="Order.php?action=order"><button style="cursor:pointer;height:50px;width:200px;background-color:orange;color:#fff;border:none">Order Now</button></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>

<?php

get_Footer()
?>