<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');
class Contactus
{


    public $db;
    public $fm;
    public $tableName = "contact_us";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
    }

    public function Contactus($data)
    {
        $name = $this->Validation($data['name']);
        $email = $data['email'];
        $mobile = $data['mobile'];
        $message = $this->Validation($data['message']);
        // echo $name;
        // echo $email;
        // echo $mobile;
        // echo $message;
        if ($name == '' || $email == '' || $mobile == '' || $message == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(contact_name,contact_email,contact_mobile,contact_message)VALUES('$name','$email','$mobile','$message')";
            $insert = $this->db->insert($sql);
            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Send Message successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong>  Message Not send
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
}
