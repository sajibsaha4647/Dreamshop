<?php

$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');
include_once($filepath . '../config/session.php');
// include_once('config/session.php');
// Session::init();
class LocalUser
{
    public $db;
    public $fm;
    public $tableName = "local_user";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
    }

    // public function ShowOrderCart()
    // {
    //     // $sessionid = session_id();
    //     $sql = "SELECT * FROM product_addcart where s_id='$sessionid'";
    //     $Getdata = $this->db->select($sql);
    //     if ($Getdata) {
    //         // $dataVal = $Getdata->fetch_assoc();
    //         return $Getdata;
    //     } else {
    //         return  false;
    //     }
    // }

    public function CustomerLogin($post)
    {
        $email = $this->Validation($post['email']);
        $password = $this->Validation($post['password']);
        if ($email == '' || $password == '') {
            return "<div><span>empty field</span></div>";
        } else {
            $sql = "SELECT * FROM $this->tableName WHERE local_email='$email' AND local_password='$password'";
            $log = $this->db->select($sql);
            if ($log !== false) {
                $value = $log->fetch_assoc();
                Session::set('CustomerLogin', true);
                Session::set('customer_id', $value['local_user_id']);
                Session::set('customer_name', $value['local_name']);
                header("location:index.php");
            } else {
                return "<div><span>Email or Password did Not match</span></div>";
            }
        }
    }

    public function insert($post)
    {
        $name = $this->Validation($post['name']);
        $city = $this->Validation($post['city']);
        $zipcode = $this->Validation($post['zipcode']);
        $email = $this->Validation($post['email']);
        $address = $this->Validation($post['address']);
        $country = $this->Validation($post['country']);
        $phone = $this->Validation($post['phone']);
        $password = $this->Validation($post['password']);
        $checkemail = $this->checkEmail($email);

        if ($name == '' || $city == '' || $zipcode == '' || $email == '' || $address == '' || $country == '' || $phone == '' || $password == '') {
            return "<div><span>empty field</span></div>";
        } else if ($checkemail == true) {
            return "<div><span>Email is already used</span></div>";
        } else {
            $sql = "INSERT INTO $this->tableName(local_name,local_email,local_zipcode,local_city,local_adress,local_country,local_phone,local_password)
            VALUES('$name','$email','$zipcode','$city','$address','$country',$phone,$password)";
            $insert = $this->db->insert($sql);
            if ($insert) {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Success!</strong> Registration Successfull
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Card Added Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    }

    public function GetinsertUserOrder()
    {
        $sessionid = session_id();
        $id = Session::get('customer_id');
        $cart = Session::get("cart")[$sessionid];
        foreach ($cart as $key => $result) {
            $product_id = $result['product_id'];
            $product_name = $result['product_name'];
            $product_price = $result['product_price'];
            $product_quantity = $result['product_quantity'];
            $product_image = $result['product_image'];
            $product_status = $result['product_status'];
            $product_date = $result['product_date'];
            $product_action = $result['product_action'];
        }
        $sql = "INSERT INTO product_addcart(local_user_id,product_id,product_name,product_price,product_quantity,product_image,product_status,product_date,product_action)VALUES('$id','$product_id','$product_name','$product_price','$product_quantity','$product_image',' $product_status','$product_date','$product_action')";
        $insert = $this->db->insert($sql);
        if ($insert) {
            Session::remove("cart");
            header("location:PaymentSuccess.php");
        }
    }

    public function showOrderList()
    {
        error_reporting(0);
        $id = Session::get('customer_id');
        $sql = "SELECT * FROM product_addcart where local_user_id='$id'";
        $select  = $this->db->select($sql);
        if ($select) {
            return $select;
        } else {
            return '<div class="alert alert-danger" role="alert">
                   <h2>No Data available</h2>
                </div>';
        }
    }



    public function showProfile()
    {
        $id = Session::get('customer_id');
        $sql = "SELECT * FROM $this->tableName WHERE local_user_id='$id'";
        $log = $this->db->select($sql);
        if ($log) {
            $value = $log->fetch_assoc();
            return $value;
        } else {
            return false;
        }
    }

    public function updateProfile($post)
    {
        $id = Session::get('customer_id');
        $local_name = $this->Validation($post['local_name']);
        $local_city = $this->Validation($post['local_city']);
        $local_zipcode = $this->Validation($post['local_zipcode']);
        $local_adress = $this->Validation($post['local_adress']);
        $local_country = $this->Validation($post['local_country']);
        $local_phone = $this->Validation($post['local_phone']);
        if ($local_name == '' || $local_city == '' || $local_zipcode == '' || $local_adress == '' || $local_country == '' || $local_phone == '') {
            return "<div><span>empty field</span></div>";
        } else {
            $sql = "UPDATE $this->tableName SET local_name='$local_name',local_zipcode='$local_city',local_city='$local_zipcode',local_adress='$local_adress',local_country='$local_country',local_phone='$local_phone' WHERE local_user_id='$id'";
            $Update = $this->db->update($sql);
            if ($Update) {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Success!</strong> Update Successfull
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

    public function checkEmail($email)
    {
        $sql = "SELECT * FROM $this->tableName WHERE local_email='$email'";
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
