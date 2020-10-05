<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');
include_once($filepath . '../config/session.php');
Session::checkLogin();



class AdminLogin
{

    public $db;
    public $fm;
    public $tableName = "shop_admin";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
    }

    public function AdminLoign($post)
    {
        $adminUser = $this->Validation($post['adminUser']);
        $adminPass = $this->Validation(md5($post['adminPass']));
        if ($adminUser == '' || $adminPass == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else {
            $sql = "SELECT * FROM $this->tableName WHERE admin_user_name='$adminUser' AND admin_pass='$adminPass' ";
            $log = $this->db->select($sql);
            if ($log == true) {
                // return "<div class='alert alert-danger'>Press</div>";
                $value =  $log->fetch_assoc();
                Session::set('login', true);
                Session::set('	admin_id', $value['	admin_id']);
                Session::set('admin_name', $value['admin_name']);
                Session::set('admin_user_name', $value['admin_user_name']);
                Session::set('admin_image', $value['admin_image']);
                Session::set('user_role_id', $value['user_role_id']);
                header("location:index.php");
            } else {
                return "<div class='alert alert-danger'>User name or password did not mathch</div>";
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
}
