<?php

$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');



class adminAccess
{
    public $db;
    private $dbname = "admin_lavel";
    public function __construct()
    {
        $this->db = new Database();
    }


    public function InsertRole($post)
    {
        $rolename = $this->Validation($post['rolename']);
        if ($rolename == '') {
            return "<div class='alert alert-danger'>empty Field</div>";
        } else {
            $sql = "INSERT INTO $this->dbname(admin_access)VALUES('$rolename')";
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

    public function ShowRole()
    {
        error_reporting(0);
        $sql = "SELECT * FROM $this->dbname";
        $select  = $this->db->select($sql);
        if ($select) {
            return $select;
        } else {
            return '<div class="alert alert-danger" role="alert">
                   <h2>No Data available</h2>
                </div>';
        }
    }

    public function DeleteRole($id)
    {
        $sql = "DELETE  FROM $this->dbname WHERE  	user_role_id='$id'";
        $delete = $this->db->delete($sql);
        return $delete;
    }

    public function UpdateRole($post)
    {
        $rolename = $this->Validation($post['rolename']);
        $id = $this->Validation($post['id']);
        if ($rolename == '') {
            return "<div class='alert alert-danger'>empty Field</div>";
        } else {
            $sql = "UPDATE $this->dbname SET admin_access='$rolename' WHERE 	user_role_id='$id'";
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

    public function GetUpdateRole($id)
    {
        $sql = "SELECT * FROM $this->dbname where user_role_id='$id'";
        $getup = $this->db->select($sql);
        $getdata = $getup->fetch_assoc();
        return $getdata;
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
}
