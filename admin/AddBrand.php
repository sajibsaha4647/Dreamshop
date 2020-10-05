<?php
require_once('functions/functions.php');
include('../classes/productBrand.php');
get_Header();
get_Sidebar();
?>

<?php
$brand = new Productbrand();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $brand->insertbrand($_POST);
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                if (isset($result)) {
                    echo $result;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brand" placeholder="Enter brand Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
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