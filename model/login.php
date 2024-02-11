<?php
//session_start();
require_once ('Connection.php');

class User extends Database
{
    private $id="";
    private $name="";
    private $pass="";
    private $email="";
    private $role="";
    private $valid=False;
    
    function __construct($id,$pass) {
        $db=new Database();
        if ($id!=""&&$pass!="") {
        $select="select * from login where ID='$id' and userpassword='$pass'";
            $query=$db->db_query($select);
            if ($db->db_num($select) > 0) {
                while($row = mysqli_fetch_array($query)) {
            //   echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["pass"]. "<br>";

            $this->valid=True;
           $this->id=$row['ID'];
           $this->name=$row['username'];
           $this->email=$row['email'];
           $this->pass=$row['userpassword'];
           $this->role=$row['role'];
            }
          }

          else {
            // echo "0 results<br>";
            $this->id=$id;
            $this->pass=$pass;
          }
        // if ($row=mysqli_fetch_array($query)){
        //     $this->valid=true;
        //     $this->id=$id;
        //    $this->name=$row['name'];
        //    $this->pass=$row['pass'];
        //    $this->role=$row['role'];
        // }

        }
        $db->db_close();
    
    }
    public static function select($id){

        $db=new Database();
        $sql = "select * from login where ID='$id'";
        $query =$db->db_query($sql);
        $myobj="";
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new User($row['ID'],$row['userpassword']);

            }
        }
        $db->db_close();
        return $myobj;//return array of objects

    }

    public function insert($id,$userName,$pass,$email,$role){
        $db=new Database();
        $sql = "INSERT INTO login(ID, username, userpassword, email, role) VALUES ('$id','$userName','$pass','$email','$role')";
        $query=$db->db_query($sql);
        $db->db_close();

    }
    public static function updateUserPassword($id,$pass){
        $db=new Database();
        $sql = "UPDATE login SET userpassword='$pass' WHERE ID='$id'";
        $query=$db->db_query($sql);
        $db->db_close();

    }
    public static function updateUserEmail($id,$email){
        $db=new Database();
        $sql = "UPDATE login SET email='$email' WHERE ID='$id'";
        $query=$db->db_query($sql);
        $db->db_close();

    }
    public static function selectByName($userName){
        $db=new Database();
        $sql = "select * from authors where authName='$userName' ";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Research($row['resID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        } else {
            echo "0 results";
        }
        $db->db_close();
        return $result;//return array of objects


    }
    public  function checkIfFoundInUingID($ID) {
        $db=new Database();
        $select="select * from authors where ID='$ID'";
        $query=$db->db_query($select);
        $found=false;
        if ($db->db_num($select) > 0) {
            $found=true;
        }
        return $found;
    }
    public static function checkIfFoundInLogInTable($ID) {
        $db=new Database();
        $select="select * from login where ID='$ID'";
        $query=$db->db_query($select);
        $found=false;
        if ($db->db_num($select) > 0) {
            $found=true;
        }
        return $found;
    }
    public static function isFound($ID) {
        $db=new Database();
        $select="select * from login where ID='$ID'";
        $query=$db->db_query($select);
        $found=false;
        if ($db->db_num($select) > 0) {
            $found=true;
        }
        return $found;
    }
    public  function checkIfFoundInResearchTable($ID) {
        $db=new Database();
        $found=array();
        $select="select * from resaech where author='$ID'";
        $query=$db->db_query($select);
        $found=false;
        if ($db->db_num($select) > 0) {
            while($row = mysqli_fetch_array($query)) {
                $found[0] = true;
                $found[1] =$row['ID'];
            }
        }
        return $found;
    }
    function get_name() {
        return $this->name;
      }
    
    function get_role() {
        return $this->role;
      }
    function get_id() {
        return $this->id;
      }
    function get_valid() {
        return $this->valid;
      }
    function get_email() {
        return $this->email;
      }

    /**
     * @return mixed|string
     */
    public function getPass(): mixed
    {
        return $this->pass;
    }

    /**
     * @param mixed|string $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed|string $name
     */
    public function setName(mixed $name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed|string $pass
     */
    public function setPass(mixed $pass): void
    {
        $this->pass = $pass;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail(mixed $email): void
    {
        $this->email = $email;
    }

    /**
     * @param mixed|string $role
     */
    public function setRole(mixed $role): void
    {
        $this->role = $role;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid): void
    {
        $this->valid = $valid;
    }
    

}
//$user=User::updateUserPassword(11,"lafi@123");
//$user=User::select(11);

//echo $user->getPass()."<br>";
// $u=new User(120192203019,"anas@103695");
//$u->insert(100,"ahmad","anas","11@gmail.com",1);
// echo "id ".$u->get_id()."<br>";
// echo "name ".$u->get_name()."<br>";
//echo "pass ".$u->getPass()."<br>";
//echo "role ".$u->get_role()."<br>";
//echo "valid ".$u->get_valid()."<br>";

?>
