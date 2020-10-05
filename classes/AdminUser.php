<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');
class AdminUser
{
    public $db;
    public $fm;
    public $tableName = "shop_admin";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
    }

    public function InsertUser($post, $file)
    {
        $name = $this->Validation($post['name']);
        $userName = $this->Validation($post['userName']);
        $email = $this->Validation($post['email']);
        $password = $this->Validation(md5($post['password']));
        $userRole = $this->Validation($post['userRole']);
        $checkEmail = $this->Validation($this->checkEmail($email));
        $parmited = array('jpeg', 'jpg', 'png', 'gif');
        $Folder = 'uploads/userimg/';
        $file_name = $file['pic']['name'];
        $temp_name = $file['pic']['tmp_name'];
        $separate = explode('.', $file_name);
        $catchname = strtolower(end($separate));
        $uniqueName = substr(md5(time()), 0, 10) . '.' . $catchname;
        $FulluniqueName = $Folder . $uniqueName;
        echo $FulluniqueName;
        move_uploaded_file($temp_name, $FulluniqueName);
        if ($name == '' || $userName == '' || $password == '' || $userRole == '' || $email == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else if (in_array($catchname, $parmited) == false) {
            return "<div class='alert alert-danger'>File type only:-. " . implode(', ', $parmited) . "</div>";
        } else if ($checkEmail == true) {
            return "<div class='alert alert-danger'>email is already exist</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(admin_name,admin_user_name,admin_email,admin_pass,user_role_id,admin_image)VALUES('$name','$userName','$email','$password','$userRole','$FulluniqueName')";
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

    public function ShowUser()
    {
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName NATURAL JOIN admin_lavel";
        $show = $this->db->select($sql);
        if ($show == true) {
            return $show;
        } else {
            return false;
        }
    }

    public function DeleteUser($id)
    {

        $sql = "DELETE FROM $this->tableName where admin_id='$id'";
        $delete = $this->db->delete($sql);
        if ($delete) {
            return $delete;
        }
    }

    public function GetUpdate($id)
    {
        $sql = "SELECT * FROM $this->tableName where admin_id='$id'";
        $Getdata = $this->db->select($sql);
        $data = mysqli_fetch_assoc($Getdata);
        return $data;
    }

    public function UpdateUser($post, $file)
    {
        $name = $this->Validation($post['name']);
        $userName = $this->Validation($post['userName']);
        $userRole = $this->Validation($post['userRole']);
        $id = $this->Validation($post['id']);
        $parmited = array('jpeg', 'jpg', 'png', 'gif');
        $Folder = 'uploads/userimg/';
        $file_name = $file['pic']['name'];
        $temp_name = $file['pic']['tmp_name'];
        $separate = explode('.', $file_name);
        $catchname = strtolower(end($separate));
        $uniqueName = substr(md5(time()), 0, 10) . '.' . $catchname;
        $FulluniqueName = $Folder . $uniqueName;
        echo $FulluniqueName;
        move_uploaded_file($temp_name, $FulluniqueName);
        if ($name == '' || $userName == '' ||  $userRole == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else if ($file_name == '') {
            $sql = "UPDATE  $this->tableName SET admin_name='$name',admin_user_name='$userName', user_role_id='$userRole'  WHERE admin_id='$id' ";
            $insert = $this->db->update($sql);
            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Upadate successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Upadate Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else if (in_array($catchname, $parmited) == false) {
            return "<div class='alert alert-danger'>File type only:-. " . implode(', ', $parmited) . "</div>";
        } else {
            $sql = "UPDATE  $this->tableName SET admin_name='$name',admin_user_name='$userName', user_role_id='$userRole' ,admin_image='$FulluniqueName' WHERE admin_id='$id' ";
            $insert = $this->db->update($sql);
            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Upadate successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Upadate Unsuccessful
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

    public function checkEmail($email)
    {
        $sql = "SELECT * FROM $this->tableName WHERE admin_email='$email'";
        $check = $this->db->select($sql);
        if ($check !== false) {
            $row = mysqli_num_rows($check);
            if ($row > 0) {
                return  true;
            } else {
                return false;
            }
        }
    }
}
