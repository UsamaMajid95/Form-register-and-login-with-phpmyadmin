<?php
session_start();

class Connection{
   public $host = 'localhost';
   public $username = 'usama';
   public $password = 'usama95';
   public $db = 'manotest';
   public $conn;

    public function __construct(){
        
        $this->conn = mysqli_connect($this->host,$this->username,$this->password,$this->db);

    }
}

class Register extends Connection{
    public function registration($login,$password,$confirm_password,$email,$name){
        $duplicate =mysqli_query($this->conn,"SELECT * FROM `registration` where login = '$login' or email = '$email' ");
        if(mysqli_num_rows($duplicate)>0){
             return 10;
             //This user already exist
        }else{
            if($password == $confirm_password ){
                $password_hash = md5($password);
                $password_hash2 =md5($confirm_password); 
                $query = "INSERT INTO `registration` VALUES ('','$login','$password_hash','$password_hash2','$email','$name')";
                mysqli_query($this->conn,$query);
                insert_json_file();
                
                return 1;
                // register successfully
            } else{
                return 100;
                //password dosenot match

            }
        }
    }
}

class Login extends Connection{
    public $id ='';
    public function login_user($login,$password){
       $result= mysqli_query($this->conn,"SELECT * FROM `registration` Where login = '$login' ");
       
       if(mysqli_num_rows($result)>0){
          $row = mysqli_fetch_assoc($result);
          if(md5($password) == $row['password']){
            $_SESSION['login1'] = True ;
            $_SESSION['id']=$row['id'];
            setcookie($login,$login,time()+3600,"/home",'localhost',TRUE,FALSE);

            
            return 1;
            //login successfully

            }else{
                return 10;
                //wrong password
            }
        }else{
          return 100;
          // user dosenot registered
        }
    }

    public function iduser(){
        return $this->id;
    }
}

class Select extends Connection{
    public function selectbyid($id){
        $result = mysqli_query($this->conn,"SELECT * FROM `registration` Where id = '$id' ");
        return mysqli_fetch_assoc($result);
    }
}

function insert_json_file(){
    $mysqli = new mysqli('localhost','usama','usama95','manotest');
    if($mysqli->connect_errno !=0){
        echo $mysqli->connect_error;
        exit();
    }
    
    $sql = "SELECT * FROM `registration` WHERE 1";
    $result = $mysqli->query($sql);
    while($user = $result->fetch_assoc()){
        $users[]=$user;
    }
    
    $encode_data=json_encode($users,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    file_put_contents('data.json',$encode_data);
}

class CRUD{
     
    public function read_data(){
        $index = 0;
        $data = file_get_contents('data.json');
        $data = json_decode($data);
        foreach($data as $row){
            echo"<tr>
                <td>$row->id</td>
                <td>$row->login</td>
                <td>$row->password</td>
                <td>$row->confirm_password</td>
                <td>$row->email</td>
                <td>$row->name</td>
                <td>
                    <a href='edit.php?index=".$index."' class='btn btn-success btn-sm'>Edit</a>
                    <a href='delete.php?index=".$index."' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>";
            $index++;
        }
        
    }

    public function edit_data(){
        $index=$_GET['index'];
        $data = file_get_contents('data.json');
        $data_array = json_decode($data);
        $row = $data_array[$index];
        if(isset($_POST['save'])){
            $input=array(
                'id'=>$_POST['id'],
                'login'=>$_POST['login'],
                'password'=>$_POST['p1'],
                'confirm_password'=>$_POST['p2'],
                'email'=>$_POST['email'],
                'name'=>$_POST['name']
            );
            $data_array[$index] = $input;
            $data = json_encode($data_array,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents('data.json',$data); 
            header('location:index.php');  
        }
        return $row;
    }
    public function delete_data(){
        $index = $_GET['index'];
        $data = file_get_contents('data.json');
        $data = json_decode($data);
        unset($data[$index]);
        $data = json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('data.json',$data);
        header('location:index.php');  

    }
}
?>