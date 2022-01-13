<?php

require_once dirname(__DIR__) . '\utils\sendMail\send_mail.php';


class Users
{
    //DB stuff

    private $conn;
    private $table = 'users1';

    private $result = NULL;

   
    // public $id;
    // public $name;
    // public $phone;
    // public $email;
    // public $gender;
    // public $date_birth;
    // public $address;
    // public $created_at;
    // public $updated_at;

    //Post properties
    private $id;
    private $name;
    private $phone;
    private $email;
    private $password;
    private $gender;
    private $date_birth;
    private $address;
    private $created_at;
    private $updated_at;

    //constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    //set id
    public function setId($id){
        $this->id = $id;
    }
    //get id
    public function getId(){
        return $this->id;
    }

    //set Name
    public function setName($name){
        $this->name = $name;
    }
    //get Name
    public function getName(){
        return $this->name;
    }

    //set Phone
    public function setPhone($phone){
        $this->phone = $phone;
    }
    //get Phone
    public function getPhone(){
        return $this->phone;
    }

    //set Email
    public function setEmail($email){
        $this->email = $email;
    }
    //get Email
    public function getEmail(){
        return $this->email;
    }

    //set Password
    public function setPassword($password){
        $this->password = $password;
    }
    //get Password
    public function getPassword(){
        return $this->password;
    }

    //set Gender
    public function setGender($gender){
        $this->gender = $gender;
    }
    //get Gender
    public function getGender(){
        return $this->gender;
    }

    //set Date_birth
    public function setDate_birth($date_birth){
        $this->date_birth = $date_birth;
    }
    //get Date_birth
    public function getDate_birth(){
        return $this->date_birth;
    }

    //set Address
    public function setAddress($address){
        $this->address = $address;
    }
    //get Address
    public function getAddress(){
        return $this->address;
    }

    //set Created_at
    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    //get Created_at
    public function getCreated_at(){
        return $this->created_at;
    }

    //set Updated_at
    public function setUpdated_at($updated_at){
        $this->updated_at = $updated_at;
    }
    //get Updated_at
    public function getUpdated_at(){
        return $this->updated_at;
    }
//------------------------------------------
    //Get all user
    public function read()
    {
        //create query
        $sql_query = "SELECT * FROM $this->table";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Search by name users
    public function search_user_name(){
        //create query
        $sql_query = "SELECT * FROM $this->table WHERE name LIKE CONCAT('%', ?, '%')";//ham concat noi nhieu chuoi thanh 1 chuoi

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        //Bind data
        $stmt->bindParam(1, $this->name);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Select by email users
    public function select_user_email_phone(){
        //create query
        $sql_query = "SELECT * FROM $this->table WHERE phone = ? OR email = ?";//ham concat noi nhieu chuoi thanh 1 chuoi

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        //Bind data
        $stmt->bindParam(1, $this->phone);
        $stmt->bindParam(2, $this->email);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Get single user
    public function read_single()
    {
        $sql_query = "SELECT * FROM $this->table WHERE id = ?";
        //Prepare statement: Khung mau voi cac (Placeholder) nhu cac tham so cua cac phuong thuc khi khai bao ham

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        //Bind id: gan gia tri cho cac placeholder
        //co 2 loai Placeholder :value or ?
        $stmt->bindParam(1, $this->id);

        //Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //set properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->phone = $row['phone'];
        $this->email = $row['email'];
        $this->gender = $row['gender'];
        $this->date_birth = $row['date_birth'];
        $this->address = $row['address'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
    }

    public function create_user()
    {
        $sql_query = "INSERT INTO $this->table(name, phone, email, password, gender, date_birth, address, created_at, updated_at) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        // clear data
        // htmlspecialchars: chuyển các thẻ trong html sang kiểu chuỗi để echo hoặc print ra ngoài
        // strip_tags: loại bỏ các thẻ trong html
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));

        //Hash password
        $this->password = password_hash(htmlspecialchars(strip_tags($this->password)), PASSWORD_DEFAULT);
        
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_birth = htmlspecialchars(strip_tags($this->date_birth));
        $this->address = htmlspecialchars(strip_tags($this->address));
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->created_at = null;
        $this->updated_at = null;

        //Bind data
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->phone);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->password);
        $stmt->bindParam(5, $this->gender);
        $stmt->bindParam(6, $this->date_birth);
        $stmt->bindParam(7, $this->address);
        $stmt->bindParam(8, $this->created_at);
        $stmt->bindParam(9, $this->updated_at);

        //Execute query
        if ($stmt->execute()) {
            //Creart verify
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            
            $verify_code = sendPHPmailer($this->email);
            
            $this->create_verify1($this->email, $verify_code, date("Y-m-d H:i:s"));

            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        //print_r("Error........print_r....: %s.\n", $stmt->error);
        return false;
    }

    public function update_user(){
        $sql_query = "UPDATE $this->table SET name = ?, phone = ?, email = ?, gender = ?, date_birth = ?, address = ?, created_at = ?, updated_at = ?
            WHERE id = ?";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        // clear data
        // htmlspecialchars: chuyển các thẻ trong html sang kiểu chuỗi để echo hoặc print ra ngoài
        // strip_tags: loại bỏ các thẻ trong html
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_birth = htmlspecialchars(strip_tags($this->date_birth));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->updated_at = date("Y-m-d H:i:s");//"Y-m-d H:i:s"
        // date_default_timezone_set('Asia/Ho_Chi_Minh');
        // echo "Today is " . date("Y-m-d H:i:s") . "<br>";

        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->phone);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->gender);
        $stmt->bindParam(5, $this->date_birth);
        $stmt->bindParam(6, $this->address);
        $stmt->bindParam(7, $this->created_at);
        $stmt->bindParam(8, $this->updated_at);
        $stmt->bindParam(9, $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        //print_r("Error........print_r....: %s.\n", $stmt->error);
        return false;
    }

    public function delete_user()
    {
        $sql_query = "DELETE FROM $this->table WHERE id = ?";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        //clear data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(1, $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        //print_r("Error........print_r....: %s.\n", $stmt->error);
        return false;
    }

    public function login(){
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

    //----------------------------------
    public function create_verify1($email, $code, $created_at)
    {
        $sql_query = "INSERT INTO verify1 (email, code, created_at) 
            VALUES('" . $email . "', '" . password_hash($code, PASSWORD_DEFAULT) . "', '" . $created_at . "')";
        //password_hash($code, PASSWORD_DEFAULT)
        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        if ($stmt->execute()){
            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        return false;
    }
    //----------------------------------

    public function select_verify1()
    {
        $sql_query = "SELECT * FROM verify1 WHERE email=?";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        $this->email = htmlspecialchars(strip_tags($this->email));

        //Bind data
        $stmt->bindParam(1, $this->email);
        //Execute query
        $stmt->execute();

        return $stmt;
    }

    public function update_password(){
        $sql_query = "UPDATE $this->table SET password = ?, created_at = ?
            WHERE email = ?";

        //prepare statement
        $stmt = $this->conn->prepare($sql_query);

        
        $this->password = password_hash(htmlspecialchars(strip_tags($this->password)), PASSWORD_DEFAULT);
        $this->created_at = null;
        $this->email = htmlspecialchars(strip_tags($this->email));
        

        //Bind data
        $stmt->bindParam(1, $this->password);
        $stmt->bindParam(2, $this->created_at);
        $stmt->bindParam(3, $this->email);

        //Execute query
        if ($stmt->execute()) {

            return true;
        }

        printf("Error........: %s.\n", $stmt->error);
        //print_r("Error........print_r....: %s.\n", $stmt->error);
        return false;
    }
    

}
