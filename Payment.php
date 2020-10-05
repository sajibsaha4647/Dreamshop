<?php
require_once('functions/function.php');
include_once('config/session.php');
Session::init();
get_Header();

?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div style="float:left">
                <div style="margin-top:50px">
                    <a href="Order.php"><button style="cursor:pointer;height:50px;width:300px;background-color:orange;color:#fff;border:none">Cash Payment</button></a>
                </div>
            </div>
            <div style="width:50%;float:right;">
                <div style="margin-top:50px">
                    <a href="Payment.php"><button onclick="return confirm('Not active!')" style="cursor:pointer;height:50px;width:300px;background-color:orange;color:#fff;border:none">Pay Card</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php

get_Footer()
?>