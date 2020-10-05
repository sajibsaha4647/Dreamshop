<?php
require_once('functions/functions.php');
include('../classes/productCategory.php');
get_Header();
get_Sidebar();
?>

<?php
$category = new ProductCategory();
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $result = $category->deleteCat($id);
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
                    foreach ($category->showCat() as $key => $value) {
                    ?>
                        <tr class="odd gradeX">
                            <td><?php echo $key + 1 ?></td>
                            <td><?= $value['cat_name'] ?></td>
                            <td><a href="Editcat.php?id=<?= $value['cat_id'] ?>">Edit</a> || <a onclick="return confirm('you wants to delete')" href="catlist.php?action=delete&id=<?= $value['cat_id'] ?>">Delete</a></td>
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