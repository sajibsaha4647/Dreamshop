<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');
class ProductCategory
{


    public $db;
    public $fm;
    public $tableName = "product_cat";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
    }

    public function insertCat($post)
    {
        $category = $this->Validation($post['category']);
        if ($category == '') {
            return "<div class='alert alert-danger'>empty Field</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(cat_name)VALUES('$category')";
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

    public function showCat()
    {
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName";
        $select  = $this->db->select($sql);
        if ($select) {
            return $select;
        } else {
            return '<div class="alert alert-danger" role="alert">
                   <h2>No Data available</h2>
                </div>';
        }
    }

    public function deleteCat($id)
    {
        $sql = "DELETE  FROM $this->tableName WHERE  cat_id='$id'";
        $delete = $this->db->delete($sql);
        return $delete;
    }

    public function EditCat($id)
    {
        $sql = "SELECT * FROM $this->tableName where cat_id='$id'";
        $getup = $this->db->select($sql);
        $getdata = $getup->fetch_assoc();
        return $getdata;
    }

    public function UpdateCat($post)
    {
        $catname = $this->Validation($post['rolename']);
        $id = $this->Validation($post['id']);
        if ($catname  == '') {
            return "<div class='alert alert-danger'>empty Field</div>";
        } else {
            $sql = "UPDATE $this->tableName SET cat_name='$catname' WHERE 	cat_id='$id'";
            $update = $this->db->update($sql);
            if ($update) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Update successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Update Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
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


    public function showAllCategory()
    {
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName order by cat_id desc";
        $select  = $this->db->select($sql);
        if ($select) {
            return $select;
        } else {
            return '<div class="alert alert-danger" role="alert">
                   <h2>No Data available</h2>
                </div>';
        }
    }
}
