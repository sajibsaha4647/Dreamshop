<?php
include_once('config/database.php');
require_once('classes/UserCart.php');
require_once('classes/LocalUser.php');
include_once('config/session.php');
$db = new Database();
$addtocart = new UserCart();
$LocalUser = new LocalUser()
?>


<?php
if (isset($_GET['Cid'])) {
    Session::destroy();
    header("location:index.php");
}
?>

<!DOCTYPE HTML>

<head>
    <title><?= $db->TitleBar() ?> - <?= $db->CatchFilename() ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script>
</head>

<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form>
                        <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart Items</span>
                            <span class="no_product">
                                <?php
                                // $result = $addtocart->GetcartVal();
                                $cart = Session::get("cart");
                                if (isset($cart)) {
                                    echo count($cart[session_id()]);
                                    // var_dump($cart);
                                    // echo Session::get("Qyt");
                                    // echo Session::get("Qyt");
                                } else {
                                    echo "(empty)";
                                }
                                ?></span>
                        </a>
                    </div>
                </div>
                <?php
                $checkLogin = Session::get('CustomerLogin');
                if ($checkLogin == true) {
                ?>
                    <div class="login"><a href="?Cid=<?= Session::get('customer_id') ?>">Logout</a></div>

                <?php } else { ?>
                    <div class="login"><a href="login.php">Login</a></div>
                <?php } ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <?php
            $path = $_SERVER['SCRIPT_FILENAME'];
            $CurrentPage = basename($path, '.php');
            ?>
            <ul class="dc_mm-orange">
                <li><a <?php if ($CurrentPage == 'index') {
                            echo 'id="active"';
                        } ?> href="index.php">Home</a></li>
                <li><a <?php if ($CurrentPage == 'products') {
                            echo 'id="active"';
                        } ?> href="products.php">Products</a> </li>
                <li><a href="topbrands.php">Top Brands</a></li>
                <li><a href="cart.php">Cart</a></li>
                <?php
                $Login = Session::get("CustomerLogin");
                if ($Login == true) {
                ?>
                    <li><a href="Profile.php">Profile</a></li>
                    <li><a href="OrderList.php">OrderList</a></li>
                <?php
                }
                ?>
                <li><a href="contact.php">Contact</a> </li>
                <div class="clear"></div>
            </ul>
        </div>