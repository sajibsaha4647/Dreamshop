<?php
require_once('functions/functions.php');
include('../classes/productBrand.php');
get_Header();
get_Sidebar();
?>

<?php
$brand = new Productbrand();
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $result = $brand->deleteBrand($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($brand->showbrand() as $key => $value) {
                    ?>
                        <tr class="odd gradeX">
                            <td><?php echo $key + 1 ?></td>
                            <td><?= $value['brand_name'] ?></td>
                            <td><a href="EditBrand.php?id=<?= $value['brand_id'] ?>">Edit</a> || <a onclick="return confirm('you wants to delete')" href="BrandList.php?action=delete&id=<?= $value['brand_id'] ?>">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
get_Footer();
?>