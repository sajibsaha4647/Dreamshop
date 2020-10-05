 <?php
    require_once('functions/functions.php');
    require_once('../classes/Allproducts.php');
    require_once('../config/database.php');
    get_Header();
    get_Sidebar();
    ?>

 <?php
    $Product = new Allproducts();
    $db = new Database();

    if (isset($_GET['action']) == 'delete') {
        $id = $_GET['id'];
        $result = $Product->deleteproduct($id);
    }

    ?>




 <div class="grid_10">
     <div class="box round first grid">
         <h2>User List</h2>
         <div class="block">
             <table class="data display datatable" id="example">
                 <thead>
                     <tr>
                         <th>Product Name</th>
                         <th>Brand Name</th>
                         <th>Category Name</th>
                         <th>Product Details</th>
                         <th>Product Type</th>
                         <th>Image</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        foreach ($Product->showproduct() as $key => $value) {
                        ?>
                         <tr class="odd gradeX">
                             <td><?php echo $value['productname'] ?></td>
                             <td><?php echo $value['brand_name'] ?></td>
                             <td><?php echo $value['cat_name'] ?></td>
                             <td><?php echo substr($value['product_body'], 0, 50) . "..." ?></td>
                             <td><?= $value['product_type'] == 1 ? "Featured" : "General" ?></td>
                             <td class="center">
                                 <img style="height:50px;width:50px" src="<?= $value['product_image'] ?>" />
                             </td>
                             <td><a href="Editproduct.php?action=edit&id=<?= $value['product_id'] ?>">Edit</a> || <a onclick="return confirm('you wants to delete')" href="productList.php?action=delete&id=<?= $value['product_id'] ?>">Delete</a></td>
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