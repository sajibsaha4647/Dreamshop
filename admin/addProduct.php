<?php
require_once('functions/functions.php');
include('../classes/Allproducts.php');
require_once('../config/database.php');
get_Header();
get_Sidebar();
?>

<?php

$product = new Allproducts();
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $product->insertproduct($_POST, $_FILES);
}

?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                if (isset($result)) {
                    echo $result;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <label>product name</label>
                        </td>
                        <td>
                            <input type="text" name="productname" placeholder="Enter product name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>product price</label>
                        </td>
                        <td>
                            <input type="number" name="price" placeholder="Enter product price..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>brand name</label>
                        </td>
                        <td>
                            <select name="brandname">
                                <option>Select Brand Name</option>
                                <?php
                                $sqlbrand = "SELECT * FROM product_brand";
                                $brand = $db->select($sqlbrand);
                                if ($brand) {
                                    while ($newbran = $brand->fetch_assoc()) {
                                ?>
                                        <option value="<?= $newbran['brand_id'] ?>"><?= $newbran['brand_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category name</label>
                        </td>
                        <td>
                            <select name="categoryname">
                                <option>Select Category Name</option>
                                <?php
                                $sqls = "SELECT * FROM  product_cat";
                                $cat = $db->select($sqls);
                                if ($cat) {
                                    while ($catres = $cat->fetch_assoc()) {
                                ?>
                                        <option value="<?= $catres['cat_id'] ?>"><?= $catres['cat_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>
                            <label>Date Picker</label>
                        </td>
                        <td>
                            <input type="text" id="date-picker" />
                        </td>
                    </tr> -->
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input name="pic" type="file" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>product content</label>
                        </td>
                        <td>
                            <!-- <textarea name="body"></textarea> -->
                            <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Product type</label>
                        </td>
                        <td>
                            <select name="producttype">
                                <option>Select ProductType</option>
                                <option value="0">general</option>
                                <option value="1">Featured</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
get_Footer();
?>