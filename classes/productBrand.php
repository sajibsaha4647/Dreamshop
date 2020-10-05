<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');

class Productbrand
{

    public $db;
    public $fm;
    public $tableName = "product_brand";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
    }

    public function insertbrand($post)
    {
        $brand = $this->Validation($post['brand']);
        if ($brand == '') {
            return "<div class='alert alert-danger'>empty Field</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(brand_name)VALUES('$brand')";
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

    public function showbrand()
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

    public function editbrand($id)
    {
        $sql = "SELECT * FROM $this->tableName where brand_id='$id'";
        $getup = $this->db->select($sql);
        $getdata = $getup->fetch_assoc();
        return $getdata;
    }

    public function updatebrand($post)
    {
        $brand_name = $this->Validation($post['brand_name']);
        $id = $this->Validation($post['id']);
        if ($brand_name  == '') {
            return "<div class='alert alert-danger'>empty Field</div>";
        } else {
            $sql = "UPDATE $this->tableName SET brand_name='$brand_name' WHERE 	brand_id='$id'";
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

    public function deleteBrand($id)
    {
        $sql = "DELETE  FROM $this->tableName WHERE  brand_id='$id'";
        $delete = $this->db->delete($sql);
        return $delete;
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

    // ==========start front view =============

    public function BrandFrontshow()
    {
        // $sql = "SELECT * FROM $this->tableName where  order by brand_id desc limit 4 ";
        // $Getdata = $this->db->select($sql);
        // if ($Getdata) {
        //     return $Getdata;
        // } else {
        //     return false;
        // }
    }
}
