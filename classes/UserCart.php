<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . '../helpers/formate.php');
include_once($filepath . '../config/database.php');
include_once($filepath . '../config/session.php');

class UserCart
{
    public $db;
    public $fm;
    private $session_id;
    public $tableName = "product_addcart";
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Formate();
        $this->session_id = session_id();
    }

    public function Addtocard($cartVal, $id)
    {

        /**
         * [
         *  sessionid_1 => [
         *  productid_1 => [
         *  
         * ],
         * prodcutid_2 => [
         * ]
         * ],
         *  session_2 => [],
         *  session_3 => []
         * ]
         * 
         * 
         * 
         */
        $product_quantity = $this->Validation($cartVal['product_quantity']);
        $productId = $this->Validation($id);
        $sql = "SELECT * FROM product_table where product_id='$productId' ";
        $Getdata = $this->db->select($sql);
        $data = $Getdata->fetch_assoc();

        $productname = $data['productname'];
        $product_price = $data['product_price'];
        $product_image = $data['product_image'];

        $cart = Session::get("cart");
        $user_cart = &$cart[$this->session_id]; //get all cart in session


        $checkExist = array_key_exists($id, $user_cart ?? []);


        if ($checkExist) {
            return '<div class="alert alert-danger" role="alert">
                    <strong>Hay!</strong> Product Allready Added
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        } else {
            $target_product = &$user_cart[$productId];

            $target_product = [
                "product_id" => $productId,
                "product_name" => $productname,
                "product_price" => $product_price,
                "product_quantity" => $product_quantity,
                "product_image" => $product_image,
            ];

            $insert = Session::set('cart', $cart);

            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                        <strong>Success!</strong> Card Added successful
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

    /**
     * 
     * [
     *  sessionid_1=>[
     *  prodcutid_1 => [
     *  quantity = >100
     * ]
     * ]
     * 
     * ]
     * 
     */


    public function UpdateCard($post)
    {
        $product_quantity = $this->Validation($post['product_quantity']);
        $product_id = $this->Validation($post['product_id']);

        $cart = Session::get("cart");
        $user_cart = &$cart[$this->session_id];
        $target_product = &$user_cart[$product_id];
        $target_product["product_quantity"] = $product_quantity;

        $insert = Session::set("cart", $cart);

        // echo "<pre>";
        // var_dump($cart);
        // echo "</pre>";

        if ($insert) {
            Session::set("cart_success", "Cart updated");
            header("Location:cart.php");
        } else {
            return '<div class="alert alert-danger" role="alert">
                    <strong>Sorry!</strong> Cart Not Updated
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }

    public function DeleteCart($id)
    {
        // $sql = "DELETE FROM $this->tableName where cartid='$id'";
        // $delete = $this->db->delete($sql);
        // if ($delete) {
        //     return $delete;
        // }


        // $cart = Session::get("cart")[$this->session_id];
        // foreach ($cart as $key => $result) {
        //     if ($result['product_id'] == $id) {
        // unset();
        //     }
        // }

        $cart = Session::get("cart");
        $user_cart = &$cart[$this->session_id]; //get all cart in session
        $delete = array_key_exists($id, $user_cart ?? []);

        if ($delete) {

            Session::remove("Qyt");
            unset($user_cart[$id]);
            Session::set('cart', $cart);
            header("location:cart.php");
        }
    }


    // public function GetcartVal()
    // {
    //     $session_id = session_id();
    //     $sql = "SELECT * FROM product_addcart where s_id='$session_id'";
    //     $Getdata = $this->db->select($sql);
    //     if ($Getdata) {
    //         return $Getdata;
    //     } else {
    //         return false;
    //     }
    // }



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
