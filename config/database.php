<?php

class Database
{

    private $host = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "dreamshop";

    public $conn;
    public $err;
    public function __construct()
    {
        $this->Dbconnection();
    }

    public function Dbconnection()
    {
        if (!isset($this->conn)) {
            $this->conn = mysqli_connect($this->host, $this->dbuser, $this->dbpass, $this->dbname);
            if (!$this->conn) {
                $this->err =  '<div class="alert alert-danger" role="alert">
                <strong>Problem!</strong> database connection error
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
                echo $this->err;
            }
        }
    }
    public function TitleBar()
    {
        $title = "Shopping-Comilla";
        return $title;
    }

    public function CatchFilename()
    { //change the title bar
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        if ($title == 'index') {
            $title = 'Home';
        } elseif ($title == 'products') {
            $title = 'Products';
        } elseif ($title == 'topbrands') {
            $title = 'Topbrands';
        } else if ($title == 'cart') {
            $title = 'Cart';
        } else if ($title == 'contact') {
            $title = 'Contact';
        } else {
            $title = 'Home';
        }
        return  $title = ucfirst($title);
    }

    public function Validation($data)
    { //validation
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->Dbconnection(), $data);
        return $data;
    }

    public function select($query)
    { //select data
        $select = $this->conn->query($query);
        if ($select->num_rows > 0) {
            return $select;
        } else {
            return false;
        }
    }
    public function insert($query)
    { //insert data
        $insert = $this->conn->query($query);
        if ($insert) {
            return $insert;
        } else {
            return false;
        }
    }
    public function update($query)
    { //update data
        $update = $this->conn->query($query);
        if ($update) {
            return $update;
        } else {
            return false;
        }
    }
    public function delete($query)
    { //delete data
        $delete = $this->conn->query($query);
        if ($delete) {
            return $delete;
        } else {
            return false;
        }
    }
}
