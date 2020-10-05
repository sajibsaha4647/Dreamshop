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

if (isset($_GET['action']) == 'delete') {
	$id = $_GET['id'];
	$result = $admin->DeleteUser($id);
}

?>




<div class="grid_10">
	<div class="box round first grid">
		<h2>User List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>name</th>
						<th>user name</th>
						<th>email</th>
						<th>user Role</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($admin->ShowUser() as $key => $value) {
					?>
						<tr class="odd gradeX">
							<td><?php echo $value['admin_name'] ?></td>
							<td><?php echo $value['admin_user_name'] ?></td>
							<td><?php echo $value['admin_email'] ?></td>
							<td class="center"> <?php echo $value['admin_access'] ?></td>
							<td class="center">
								<img style="height:50px;width:50px" src="<?= $value['admin_image'] ?>" />
							</td>
							<td><a href="EditUser.php?action=edit&id=<?= $value['admin_id'] ?>">Edit</a> || <a onclick="return confirm('you wants to delete')" href="UserList.php?action=delete&id=<?= $value['admin_id'] ?>">Delete</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<?php
get_Footer();
?>