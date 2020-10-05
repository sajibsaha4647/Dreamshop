<?php
require_once('functions/functions.php');
require_once('../classes/AdminUser.php');
require_once('../config/database.php');
get_Header();
get_Sidebar();
?>

<?php

$admin = new AdminUser();
$db = new Database();

?>
<?php


$id = $_GET['id'];
$result = $admin->GetUpdate($id);


?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $res = $admin->UpdateUser($_POST, $_FILES);
}

?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update User</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                if (isset($res)) {
                    echo $res;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?= $result['admin_id'] ?>" placeholder="Enter Name" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?= $result['admin_name'] ?>" placeholder="Enter Name" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>UserName</label>
                        </td>
                        <td>
                            <input type="text" name="userName" value="<?= $result['admin_user_name'] ?>" placeholder="Enter User Name" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>UserRole</label>
                        </td>
                        <td>
                            <select id="select" name="userRole">
                                <option>Select User Role</option>
                                <?php
                                $sql = "SELECT * FROM admin_lavel";
                                $role = $db->conn->query($sql);
                                if ($role) {
                                    while ($val = $role->fetch_assoc()) {
                                ?>
                                        <option value="<?= $val['user_role_id'] ?>" <?php if ($val['user_role_id'] == $result['user_role_id']) {
                                                                                        echo 'selected="selected"';
                                                                                    } ?>><?= $val['admin_access'] ?></option>
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
                    <!-- <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce"></textarea>
                        </td>
                    </tr> -->
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