<?php
require_once ('Connection.php');

class Research extends Database
{
    private $id="";
    private $tittle="";
    private $journal="";
    private $ISSN="";
    private $EISSN="";
    private $authID="";
    private $PublicationDate="";
    private $VL="";
    private $IS="";
    private $Status="";
    private $authName="";

    function __construct($id) {
        $db=new Database();
        if ($id!="") {
        $select="select * from resaech where ID='$id'";
            $query=$db->db_query($select);
        if ($db->db_num($select) > 0) {
            while($row = mysqli_fetch_array($query)) {
            $this->id=$row['ID'];
           $this->tittle=$row['tittle'];
           $this->journal=$row['journal'];
           $this->ISSN=$row['ISSN'];
           $this->EISSN=$row['EISSN'];
           $this->authID=$row['author'];
           $this->authName=$row['authName'];
           $this->PublicationDate=$row['PublicationDate'];
           $this->VL=$row['VL'];
           $this->IS=$row['resIS'];
           $this->Status=$row['status'];
            }
          } 
          else {
            $this->id=$id;
          }

        }
        $db->db_close();
    }
//    function getStatus($resID){
//        $db=new Database();
//        $select="select * from resaech where ID='$resID'";
//        $query=$db->db_query($select);
//        $found=false;
//        if ($db->db_num($select) > 0) {
//            $found=true;
//        }
//        return $found;
//    }
//    function updateStatus($resID,$status){
//        $db=new Database();
//        $sql = "UPDATE resaech SET status = '$status' WHERE ID = '$resID';";
//        $query=$db->db_query($sql);
//        $db->db_close();
//    }
    public static function isFoundInTable($ID)
    {
        $db=new Database();
        $sql = "select * from resaech where ID='$$ID' ";
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
    public static function isFoundInTableByTitle($id,$title)
    {
        $db=new Database();
        $sql = "select * from resaech where author='$id' and tittle='$title' ";
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
     public function selectBYTitle($tittle){
         $db=new Database();
         $sql = "select * from resaech where tittle='$tittle'";
         $query =$db->db_query($sql);
         $obj="";
         if ($db->db_num($sql) > 0) {
          while($row = mysqli_fetch_array($query)) {
                $obj=new Research($row['ID']);
            }
         }
         $db->db_close();
         return $obj ;
     }
    public static function selectByStatus($status){
        $db=new Database();
        $sql = "select * from resaech where status='$status'";
        $query =$db->db_query($sql);
        $obj="";
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            while($row = mysqli_fetch_array($query)) {
                $myobj=new Research($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result ;
    }

    public static function selectByID($resID){
        $db=new Database();
        $sql = "select * from resaech where ID  LIKE '$resID%'";
        $query =$db->db_query($sql);
        $obj="";
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            while($row = mysqli_fetch_array($query)) {
                $myobj=new Research($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result ;
    }
    public static function selectByAuthorID($authorID){
        $db=new Database();
        $sql = "select * from resaech where author   LIKE '$authorID%'";
        $query =$db->db_query($sql);
        $obj="";
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            while($row = mysqli_fetch_array($query)) {
                $myobj=new Research($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result ;
    }
    public static function selectByPublicationDate($PublicationDate){
        $db=new Database();
        $sql = "select * from resaech where PublicationDate  LIKE '$PublicationDate%'";
        $query =$db->db_query($sql);
        $obj="";
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            while($row = mysqli_fetch_array($query)) {
                $myobj=new Research($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result ;
    }
      public static function selectAll(){
          $db=new Database();
        $sql = "select * from resaech";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Research($row['ID']);
                $result[$i]=$myobj;//store each row in object 
                $i++;
            }
          }
          $db->db_close();
        return $result;//return array of objects

          
    }
    public static function selectAllResWhereHaveSameAuthor($ID){
        $db=new Database();
        $sql = "SELECT * FROM resaech WHERE author='$ID'";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Research($row['ID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }
    public function insert($ti,$jo,$auth ,$authName,$issn,$eissn,$pd,$vl,$is,$cop){
        $db=new Database();
        $sql = "INSERT INTO resaech (tittle, journal, author,authName,ISSN, EISSN, PublicationDate, VL, resIS, status) VALUES ('$ti', '$jo','$auth','$authName','$issn','$eissn','$pd','$vl','$is','$cop')";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public function updateStatus($resID,$status){
        $db=new Database();
        $sql = "UPDATE resaech SET status=$status WHERE ID=$resID";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public  static function Delete($resID){
        $db=new Database();
        $sql = "DELETE FROM resaech WHERE ID=$resID";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public function DeleteRes(){
        $db=new Database();
        $sql = "DELETE FROM resaech WHERE ID=$this->id";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    /**
     * @return mixed|string
     */
    public function getAuthName(): mixed
    {
        return $this->authName;
    }

    /**
     * @param mixed|string $authName
     */
    public function setAuthName(mixed $authName): void
    {
        $this->authName = $authName;
    }
    /**
     * @param string $id
     */

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed|string $tittle
     */
    public function setTittle(mixed $tittle): void
    {
        $this->tittle = $tittle;
    }

    /**
     * @param mixed|string $journal
     */
    public function setJournal(mixed $journal): void
    {
        $this->journal = $journal;
    }

    /**
     * @param mixed|string $ISSN
     */
    public function setISSN(mixed $ISSN): void
    {
        $this->ISSN = $ISSN;
    }

    /**
     * @param mixed|string $EISSN
     */
    public function setEISSN(mixed $EISSN): void
    {
        $this->EISSN = $EISSN;
    }

    /**
     * @param mixed|string $PublicationDate
     */
    public function setPublicationDate(mixed $PublicationDate): void
    {
        $this->PublicationDate = $PublicationDate;
    }

    /**
     * @param mixed|string $VL
     */
    public function setVL(mixed $VL): void
    {
        $this->VL = $VL;
    }

    /**
     * @param mixed|string $IS
     */
    public function setIS(mixed $IS): void
    {
        $this->IS = $IS;
    }

    /**
     * @param mixed|string $Status
     */
    public function setStatus(mixed $Status): void
    {
        $this->Status = $Status;
        $db=new Database();
        $sql = "UPDATE resaech SET Status = '$Status' WHERE ID = '$this->id';";
        $query=$db->db_query($sql);
        $db->db_close();
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getTittle(): mixed
    {
        return $this->tittle;
    }

    /**
     * @return mixed|string
     */
    public function getJournal(): mixed
    {
        return $this->journal;
    }

    /**
     * @return mixed|string
     */
    public function getISSN(): mixed
    {
        return $this->ISSN;
    }

    /**
     * @return mixed|string
     */
    public function getEISSN(): mixed
    {
        return $this->EISSN;
    }

    /**
     * @return mixed|string
     */
    public function getPublicationDate(): mixed
    {
        return $this->PublicationDate;
    }

    /**
     * @return mixed|string
     */
    public function getVL(): mixed
    {
        return $this->VL;
    }

    /**
     * @return mixed|string
     */
    public function getIS(): mixed
    {
        return $this->IS;
    }

    /**
     * @return mixed|string
     */
    public function getStatus(): mixed
    {

        return $this->Status;
    }


    /**
     * @return mixed|string
     */
    public function getAuthID(): mixed
    {
        return $this->authID;
    }

}
/*
 $u=new Research(0);
//$n=array("anas","lafi");
$u->insert("hgh","jordan",22,"anas lafi","12345","23456",7,8,6,1);*/
// echo "id ".$u->getId()."<br>";
// echo "name ".$u->getTittle()."<br>";
//echo "journal ".$u->getJournal()."<br>";
//echo "status ".$u->getStatus()."<br>";
//$u->setStatus(3);
//echo "status ".$u->getStatus()."<br>";

// echo "role ".$u->get_role()."<br>";
//
//$result=Research::selectAll();
//for ($i=0; $i <count($result) ; $i++) {
//
//    echo "<a href='userController.php?id=".$result[$i]->getId()."'>".$result[$i]->getTittle()."</a><br>";
//}
?>
