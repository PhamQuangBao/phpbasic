<?php

require_once dirname(__DIR__) . '\utils\sendMail\send_mail.php';

class Verify
{
    private $conn;
    private $table = 'verify1';

    //Post properties
    private $email;
    private $code;
    private $created_at;

    //constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //set id
    public function setEmail($email)
    {
        $this->email = $email;
    }
    //get id
    public function getEmail()
    {
        return $this->email;
    }

    //set Name
    public function setCode($code)
    {
        $this->code = $code;
    }
    //get Name
    public function getCode()
    {
        return $this->code;
    }

    //set Phone
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    //get Phone
    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function create_verify()
    {
        $sql_query = "INSERT INTO verify1 (email, code, created_at) 
            VALUES( ?, ?, ?)";
        //password_hash($code, PASSWORD_DEFAULT)
        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        $this->email = htmlspecialchars(strip_tags($this->email));
            
        $this->code = password_hash(sendPHPmailer($this->email), PASSWORD_DEFAULT);
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->created_at = date("Y-m-d H:i:s");

        //Bind data
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->code);
        $stmt->bindParam(3, $this->created_at);

        if ($stmt->execute()){
            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        return false;
    }

    public function select_verify()
    {

        $sql_query = "SELECT * FROM $this->table WHERE email=?";
        //prepare statement
        $stmt = $this->conn->prepare($sql_query);
        
        $this->email = htmlspecialchars(strip_tags($this->email));

        //Bind data
        $stmt->bindParam(1, $this->email);
        //Execute query
        $stmt->execute();

        return $stmt;
    }

    public function update_verify()
    {
 

        $sql_query = "UPDATE $this->table SET email = ?, code = ?, created_at = ?
            WHERE email = ?";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        // clear data
        // htmlspecialchars: chuyển các thẻ trong html sang kiểu chuỗi để echo hoặc print ra ngoài
        // strip_tags: loại bỏ các thẻ trong html
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->code = $this->code = password_hash(sendPHPmailer($this->email), PASSWORD_DEFAULT);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $new_crearted_at = date("Y-m-d H:i:s"); //"Y-m-d H:i:s"
        $this->created_at = $new_crearted_at;
        // date_default_timezone_set('Asia/Ho_Chi_Minh');
        // echo "Today is " . date("Y-m-d H:i:s") . "<br>";

        //Bind data
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->code);
        $stmt->bindParam(3, $this->crearted_at);
        $stmt->bindParam(4, $this->email);
        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        //print_r("Error........print_r....: %s.\n", $stmt->error);
        return false;
    }

    public function delete_verify(){
        $sql_query = "DELETE FROM $this->table WHERE email = ?";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        //clear data
        $this->email = htmlspecialchars(strip_tags($this->email));

        //Bind data
        $stmt->bindParam(1, $this->email);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        //print_r("Error........print_r....: %s.\n", $stmt->error);
        return false;
    }
    public function update_user(){
        $sql_query = "UPDATE users1 SET created_at = ?
            WHERE email = ?";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        // clear data
        // htmlspecialchars: chuyển các thẻ trong html sang kiểu chuỗi để echo hoặc print ra ngoài
        // strip_tags: loại bỏ các thẻ trong html
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $new_time = date("Y-m-d H:i:s");//"Y-m-d H:i:s"
        $this->created_at = $new_time;
        // date_default_timezone_set('Asia/Ho_Chi_Minh');
        // echo "Today is " . date("Y-m-d H:i:s") . "<br>";

        //Bind data
        $stmt->bindParam(1, $this->created_at);
        $stmt->bindParam(2, $this->email);
        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        //print_r("Error........print_r....: %s.\n", $stmt->error);
        return false;
    }


}


// class Model_Verify{
//     private $conn;
//     private $table = 'verify1';

//     public function __construct($db)
//     {
//         $this->conn = $db;
//     }

//     public function select_verify(){
//         include_once '../Entities/Verify.php';
//         echo "-1|";
//         $verifys = new Verify();
//         echo "-2|";
//         $sql_query = "SELECT * FROM $this->table WHERE email=?";
//         //prepare statement
//         $stmt = $this->conn->prepare($sql_query);
//         echo "-3|";
//         // $verifys->setEmail(htmlspecialchars(strip_tags($verifys->getEmail())));
//         $test = $verifys->getEmail();
//         echo "email.---: $test";
//         echo "-4|";
//         //Bind data
//         $stmt->bindParam(1, $verifys->getEmail());
//         echo "-5|";
//         //Execute query
//         $stmt->execute();
        
//         return $stmt;
//     }

//     public function update_user(){
//         $verifys = new Verify();

//         $sql_query = "UPDATE $this->table SET email = ?, code = ?, created_at = ?
//             WHERE email = ?";

//         //prepare statement
//         $stmt = $this->conn->prepare($sql_query);

//         // clear data
//         // htmlspecialchars: chuyển các thẻ trong html sang kiểu chuỗi để echo hoặc print ra ngoài
//         // strip_tags: loại bỏ các thẻ trong html
//         $verifys->setEmail(htmlspecialchars(strip_tags($verifys->getEmail())));
//         $verifys->setCode(htmlspecialchars(strip_tags($verifys->getCode())));

//         date_default_timezone_set('Asia/Ho_Chi_Minh');
//         $new_crearted_at = date("Y-m-d H:i:s");//"Y-m-d H:i:s"
//         $verifys->setCreated_at($new_crearted_at);
//         // date_default_timezone_set('Asia/Ho_Chi_Minh');
//         // echo "Today is " . date("Y-m-d H:i:s") . "<br>";

//         //Bind data
//         $stmt->bindParam(1, $verifys->getEmail());
//         $stmt->bindParam(2, $verifys->getCode());
//         $stmt->bindParam(3, $verifys->getCreated_at());
//         $stmt->bindParam(4, $verifys->getEmail());

//         //Execute query
//         if ($stmt->execute()) {
//             return true;
//         }

//         printf("Error........: %s.\n", $stmt->error);
//         //print_r("Error........print_r....: %s.\n", $stmt->error);
//         return false;
//     }


// }