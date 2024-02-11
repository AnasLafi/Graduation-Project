<?php
require_once ('Connection.php');
class Authors extends Database
{

    private $resID;
    private $ID;
    private $authName;
    private $jordanian;
    private  $authorsRanking;

    public function __construct($ID)
    {
        $db=new Database();
        if ($ID !="") {
            $select="select * from authors where ID ='$ID '";
            $query=$db->db_query($select);
            if ($db->db_num($select) > 0) {
                while($row = mysqli_fetch_array($query)) {

                    $this->authName=$row['authName'];
                    $this->resID=$row['resID'];
                    $this->ID=$row['ID'];
                    $this->jordanian=$row['jordanian'];
                    $this->authorsRanking=$row['authors_ranking'];


                }
            }
            else {
                $this->ID=$ID ;
            }

        }
        $db->db_close();
    }
    public static function selectAll(){
        $db=new Database();
        $sql = "select * from authors ";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
//echo $row['ID'];
                                $myobj=new Authors($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }

        $db->db_close();
        return $result;//return array of objects


    }

    public function selectByAuthIDAndResID($authID,$resID):void {
        $db=new Database();
        $sql = "select * from authors where ID='$authID' and resID='$resID'";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
//echo $row['ID'];
                $this->authName=$row['authName'];
                $this->resID=$row['resID'];
                $this->ID=$row['ID'];
                $this->jordanian=$row['jordanian'];
                $this->authorsRanking=$row['authors_ranking'];

//                $myobj=new Authors($row['ID']);
//                $result[$i]=$myobj;//store each row in object
//                $i++;
            }
        }

        $db->db_close();



    }
    public static function isFoundInTable($ID)
    {
        $db=new Database();
        $sql = "select * from authors WHERE ID='$ID' ";
        $query =$db->db_query($sql);
        $found="";
        $i=0;
        if ($db->db_num($sql) > 0) {
            $found=true;
        } else {
            $found=false;
        }
        $db->db_close();
        return $found;
    }
    public static function howManyTimesTheAuthorRepeated($ID)
    {
        $db=new Database();
        $sql = "SELECT COUNT(ID) AS total FROM `authors` WHERE ID='$ID';";
        $query =$db->db_query($sql);
        $repeated="";
        $data=mysqli_fetch_array($query);
        echo $data['total'];
        $db->db_close();
        return $repeated;
    }
//    public static function isFoundInTableByName($userName)
//    {
//        $db=new Database();
//        $sql = "select * from authors WHERE authName LIKE '%$userName%' ";
//        $query =$db->db_query($sql);
//        $found="";
//        $i=0;
//        $myobj=null;
//        if ($db->db_num($sql) > 0) {
//            while($row = mysqli_fetch_array($query)) {
//
//                $myobj=new Authors($row['ID']);
//            }
//            $found=true;
//        } else {
//            $found=false;
//        }
//        $db->db_close();
//        return array($myobj, $found);
//    }
    public static function isFoundInTableByName($userName)
    {
        $db=new Database();
        $sql = "select * from authors WHERE authName LIKE '%$userName%' ";
        $query =$db->db_query($sql);
        $found="";
        $i=0;
        $result=array();
        $myobj=null;
        if ($db->db_num($sql) > 0) {
            while($row = mysqli_fetch_array($query)) {
                $myobj=new Authors($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
            $found=true;
        } else {
            $found=false;
        }
        $db->db_close();
        return array($result, $found);
    }
    public static function selectByResID($resID){
        $db=new Database();
        $sql = "select * from authors WHERE resID='$resID' HAVING resID";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
//                $myobj=new Authors($row['ID']);

                $result[$i]=array($row["ID"],$row["authName"],$row["resID"],$row["authors_ranking"],$row['jordanian']);//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }

    public static  function Delete($resID){
        $db=new Database();
        $sql = "DELETE FROM authors WHERE resID=$resID";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public static function selectByName($authName){
        $db=new Database();
        $sql = "select * from authors WHERE authName='$authName' ";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Authors($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }
    public static function selectRes($resID){
        $db=new Database();
        $sql = "select * from authors WHERE resID='$resID'";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Authors($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }
    public static function selectAllAuthorsByID($ID){
        $db=new Database();
        $sql = "select * from authors WHERE ID='$ID' ";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Authors($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }
    public function insert($ID,$authorsRanking,$autName,$resId,$jo){
        $db=new Database();
        $sql = "INSERT INTO authors VALUES ('$ID','$authorsRanking','$autName','$resId','$jo')";
        $query=$db->db_query($sql);
        $db->db_close();
    }

    /**
     * @return mixed
     */
    public function getID(): mixed
    {
        return $this->ID;
    }


    /**
     * @return mixed
     */
    public function getAuthorsRanking(): mixed
    {
        return $this->authorsRanking;
    }




    /**
     * @return mixed
     */
    public function getResID(): mixed
    {
        return $this->resID;
    }

    /**
     * @param mixed $resID
     */
    public function setResID(mixed $resID): void
    {
        $this->resID = $resID;
    }

    /**
     * @return mixed
     */
    public function getAuthName(): mixed
    {
        return $this->authName;
    }

    /**
     * @param mixed $authName
     */
    public function setAuthName(mixed $authName): void
    {
        $this->authName = $authName;
    }

    /**
     * @return mixed
     */
    public function getJordanian(): mixed
    {
        return $this->jordanian;
    }

    /**
     * @param mixed $jordanian
     */
    public function setJordanian(mixed $jordanian): void
    {
        $this->jordanian = $jordanian;
    }

}
//$a=new Authors(11);
//$a=Authors::howManyTimesTheAuthorRepeated(11);
//print_r($a);
//echo $a->()."<br>";
//echo $a->getAuthorsRanking()."<br>";

//$result=Authors::selectByResID(742);
//echo count($result);
//for ($i=0; $i <count($result) ; $i++) {
//
//    echo "<a href='userController.php?id=".$result[$i]->getResID()."'>".$result[$i]->getAuthorsRanking().":".$result[$i]->getResID()." : ".$result[$i]->getAuthName()."</a><br>";
//}
//$a=Authors::isFoundInTableByName("Scherer");
//print_r($a);

?>