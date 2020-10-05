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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $admin->InsertUser($_POST, $_FILES);
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
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
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter Name" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>UserName</label>
                        </td>
                        <td>
                            <input type="text" name="userName" placeholder="Enter User Name" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" name="email" placeholder="Enter User Email" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter User Password" class="medium" />
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
                                    while ($result = $role->fetch_assoc()) {
                                ?>
                                        <option value="<?= $result['user_role_id'] ?>"><?= $result['admin_access'] ?></option>
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