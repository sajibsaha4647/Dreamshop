<?php
require_once('functions/functions.php');
include('../classes/productCategory.php');
get_Header();
get_Sidebar();
?>

<?php

$category = new ProductCategory();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $category->UpdateCat($_POST);
}

?>

<?php
$id = $_GET['id'];
$data = $category->EditCat($id)
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <form action="" method="POST">
                <?php
                if (isset($result)) {
                    echo $result;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $data['cat_id'] ?>" placeholder="Enter Role Name..." class="medium" />
                        </td>
                        <td>
                            <input type="text" name="rolename" value="<?php echo $data['cat_name'] ?>" placeholder="Enter Role Name..." class="medium" />
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