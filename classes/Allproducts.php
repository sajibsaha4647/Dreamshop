<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');
class Allproducts
{

    public $db;
    public $fm;
    public $tableName = "product_table";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
    }


    public function insertproduct($post, $file)
    {
        $productname = $this->Validation($post['productname']);
        $price = $this->Validation($post['price']);
        $brandname = $post['brandname'];
        $categoryname = $post['categoryname'];
        $body = $this->Validation($post['body']);
        $producttype = $this->Validation($post['producttype']);
        $parmited = array('jpeg', 'jpg', 'png', 'gif');
        $Folder = 'uploads/productimage/';
        $file_name = $file['pic']['name'];
        $temp_name = $file['pic']['tmp_name'];
        $separate = explode('.', $file_name);
        $catchname = strtolower(end($separate));
        $uniqueName = substr(md5(time()), 0, 10) . '.' . $catchname;
        $FulluniqueName = $Folder . $uniqueName;
        move_uploaded_file($temp_name, $FulluniqueName);

        if ($productname == '' || $price == '' || $brandname == '' || $categoryname == '' || $body == '' || $producttype == '' || $file_name == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else
        if (in_array($catchname, $parmited) == false) {
            return "<div class='alert alert-danger'>File type only:-. " . implode(', ', $parmited) . "</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(productname,brand_id,cat_id,product_body,product_price,product_image,product_type)VALUES('$productname','$brandname','$categoryname','$body','$price','$FulluniqueName','$producttype')";
            $insert = $this->db->insert($sql);
            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Insert successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Insert Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    }

    public function showproduct()
    {
        error_reporting(0);
        $sql = "SELECT  product_table.*,product_cat.cat_name ,product_brand.brand_name
        FROM $this->tableName 
        INNER JOIN product_cat 
        ON $this->tableName.cat_id = product_cat.cat_id
        INNER JOIN  product_brand 
        ON $this->tableName.brand_id =  product_brand.brand_id
        ORDER BY $this->tableName.product_id DESC";
        $show = $this->db->select($sql);
        if ($show == true) {
            return $show;
        } else {
            return false;
        }
    }

    public function editproduct($id)
    {
        $sql = "SELECT * FROM $this->tableName where product_id='$id'";
        $Getdata = $this->db->select($sql);
        $data = mysqli_fetch_assoc($Getdata);
        return $data;
    }

    public function updateproduct($post, $file)
    {
        $productname = $this->Validation($post['productname']);
        $price = $this->Validation($post['price']);
        $brandname = $post['brandname'];
        $product_id = $post['product_id'];
        $categoryname = $post['categoryname'];
        $body = $this->Validation($post['body']);
        $producttype = $this->Validation($post['producttype']);
        $parmited = array('jpeg', 'jpg', 'png', 'gif');
        $Folder = 'uploads/productimage/';
        $file_name = $file['pic']['name'];
        $temp_name = $file['pic']['tmp_name'];
        $separate = explode('.', $file_name);
        $catchname = strtolower(end($separate));
        $uniqueName = substr(md5(time()), 0, 10) . '.' . $catchname;
        $FulluniqueName = $Folder . $uniqueName;
        move_uploaded_file($temp_name, $FulluniqueName);

        if ($productname == '' || $price == '' || $brandname == '' || $categoryname == '' || $body == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else if ($file_name == '') {
            $sql = "UPDATE  $this->tableName SET productname='$productname',brand_id='$brandname',cat_id='$categoryname',product_body='$body',product_price='$price',product_type='$producttype' where product_id='$product_id'";
            $insert = $this->db->update($sql);
            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Insert successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Insert Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            if (in_array($catchname, $parmited) == false) {
                return "<div class='alert alert-danger'>File type only:-. " . implode(', ', $parmited) . "</div>";
            } else {
                $sql = "UPDATE  $this->tableName SET productname='$productname',brand_id='$brandname',cat_id='$categoryname',product_body='$body',product_price='$price',product_image='$FulluniqueName',product_type='$producttype' where product_id='$product_id'";
                $insert = $this->db->update($sql);
                if ($insert) {
                    return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Insert successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                } else {
                    return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Insert Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }
            }
        }
    }

    public function deleteproduct($id)
    {
        $sql = "DELETE FROM $this->tableName where product_id='$id'";
        $delete = $this->db->delete($sql);
        if ($delete) {
            return $delete;
        }
    }

    public function Validation($data)
    { //validation
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->db->conn, $data);
        return $data;
    }

    // =========Front View ============

    public function GetNewProduct()
    {
        // error_reporting(0)
        $sql = "SELECT * FROM $this->tableName where product_type='0' order by product_id desc limit 4 ";
        $Getdata = $this->db->select($sql);
        if ($Getdata) {
            return $Getdata;
        } else {
            return false;
        }
    }
    public function GetFeatureProduct()
    {
        // error_reporting(0)
        $sql = "SELECT * FROM $this->tableName where product_type='1' order by product_id desc limit 4 ";
        $Getdata = $this->db->select($sql);
        if ($Getdata) {
            return $Getdata;
        } else {
            return false;
        }
    }


    public function GetBrandProduct()
    {
        $sql = " SELECT $this->tableName.*,product_cat.cat_name ,product_brand.brand_name
        FROM $this->tableName 
        INNER JOIN product_cat 
        ON $this->tableName.cat_id = product_cat.cat_id
        INNER JOIN  product_brand 
        ON $this->tableName.brand_id =  product_brand.brand_id
        ORDER BY $this->tableName.product_id DESC limit 4";
        $show = $this->db->select($sql);
        if ($show == true) {
            return $show;
        } else {
            return false;
        }
    }

    public function Productdetails($id)
    {
        // echo $id;
        // $sql = "SELECT * FROM $this->tableName where product_id='$id' ";
        $sql = " SELECT $this->tableName.*,product_cat.cat_name ,product_brand.brand_name
        FROM $this->tableName 
        INNER JOIN product_cat 
        ON $this->tableName.cat_id = product_cat.cat_id
        INNER JOIN  product_brand 
        ON $this->tableName.brand_id =  product_brand.brand_id
        where product_id='$id'";
        $details = $this->db->select($sql);
        $data = mysqli_fetch_assoc($details);
        return $data;
    }

    public function IphoneBrandProduct()
    {
        $sql = "SELECT * FROM $this->tableName where brand_id='2' order by product_id desc limit 4";
        $details = $this->db->select($sql);
        return $details;
    }

    public function AserBrandProduct()
    {
        $sql = "SELECT * FROM $this->tableName where brand_id='4' order by product_id desc limit 4";
        $details = $this->db->select($sql);
        return $details;
    }

    public function sumsangproduct()
    {
        $sql = "SELECT * FROM $this->tableName where brand_id='3' order by product_id desc limit 4";
        $details = $this->db->select($sql);
        return $details;
    }

    public function cannonProduct()
    {
        $sql = "SELECT * FROM $this->tableName where brand_id='5' order by product_id desc limit 4";
        $details = $this->db->select($sql);
        return $details;
    }


    public function showProductByCategory($id)
    {
        $sql = "SELECT * FROM $this->tableName where cat_id='$id' order by product_id desc limit 8";
        $details = $this->db->select($sql);
        return $details;
    }
}
