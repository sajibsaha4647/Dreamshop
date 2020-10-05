<?php
require_once('functions/functions.php');
include('../classes/adminLavel.php');
get_Header();
get_Sidebar();
?>
<?php
$role = new adminAccess();

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $result = $role->DeleteRole($id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">
            <?php if (isset($result)) { ?>
                <?php echo '<div class="alert alert-success" role="alert">
                                  <strong>Success!</strong> Data Deleted
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>'; ?>
            <?php } else if (!isset($result)) {
                echo "";
            ?>

            <?php } ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Role Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($role->ShowRole() as $key => $val) {
                    ?>
                        <tr class="odd gradeX">
                            <td><?= $key + 1 ?></td>
                            <td><?= $val['admin_access'] ?></td>
                            <td><a href="EditRole.php?id=<?= $val['user_role_id'] ?>">Edit</a> || <a href="Rolelist.php?action=delete&id=<?= $val['user_role_id'] ?>">Delete</a></td>
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