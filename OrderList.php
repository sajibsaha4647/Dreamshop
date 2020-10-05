<?php
require_once('functions/function.php');
include_once('config/session.php');
include_once('helpers/formate.php');
require_once('classes/LocalUser.php');
Session::init();
get_Header();
$local = new LocalUser();
$formate = new Formate();
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <h2>Order list</h2>
            <table style="border:1px solid #000;float:left;margin-bottom:30px;margin-right:30px">
                <tr style="background-color:#ddd">
                    <th width="20% ;font-size:16px">Product Name</th>
                    <th width="15% ;font-size:16px">Price</th>
                    <th width="10% ;font-size:16px">Quantity</th>
                    <th width="20% ;font-size:16px">Total Price</th>
                    <th width="20% ;font-size:16px">date time</th>
                    <th width="20% ;font-size:16px">status</th>
                    <th width="20% ;font-size:16px">action</th>
                </tr>
                <?php
                foreach ($local->showOrderList() as $key => $value) {
                ?>
                    <tr>
                        <td style="padding-top:15px;text-align:center;padding-top:10px"><?= $value['product_name'] ?></td>
                        <td style="padding-top:15px;text-align:center;padding-top:10px"><?= $value['product_price'] ?></td>
                        <td style="padding-top:15px;text-align:center;padding-top:10px"><?= $value['product_quantity'] ?></td>
                        <td style="padding-top:15px;text-align:center;padding-top:10px"><?= $total = ($value['product_price']) * ($value['product_quantity'])  ?></td>
                        <td style="padding-top:15px;text-align:center;padding-top:10px"><?= $formate->formatDate($value['product_date']) ?></td>
                        <td style="padding-top:15px;text-align:center;padding-top:10px">Pending</td>
                        <td style="padding-top:15px;text-align:center;padding-top:10px">NA</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
</div>

<?php

get_Footer()
?>