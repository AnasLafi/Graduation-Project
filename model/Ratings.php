<?php
include_once 'Connection.php';
class Ratings
{
    private $resID;
    private $scopus;
    private $clarivate;
    private $pubmed;
    private  $foreign_researcher;
    private  $multiple_universities;
    private  $university_name;



    public function __construct($resID)
    {
        $db=new Database();
        if ($resID !="") {
            $select="select * from ratings where resID ='$resID '";
            $query=$db->db_query($select);
            if ($db->db_num($select) > 0) {
                while($row = mysqli_fetch_array($query)) {
                    $this->resID=$row['resID'];
                    $this->scopus=$row['scopus'];
                    $this->clarivate=$row['clarivate'];
                    $this->pubmed=$row['pubmed'];
                    $this->university_name=$row['university_name'];
                    $this->multiple_universities=$row['multiple_universities'];
                    $this->foreign_researcher=$row['foreign_researcher'];


                }
            }
            else {
                $this->resID=$resID ;
            }

        }
        $db->db_close();
    }
    public static  function Delete($resID){
        $db=new Database();
        $sql = "DELETE FROM ratings WHERE resID=$resID";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public function insert($resID,$scopus,$cle,$pub,$foreign,$multi,$uniName){
        $db=new Database();
        $sql = "INSERT INTO ratings VALUES ('$resID','$scopus','$cle','$pub','$foreign','$multi','$uniName')";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public static function isFoundInTable($ID)
    {
        $db=new Database();
        $sql = "select * from ratings where resID='$$ID' ";
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
    public function update($scopus,$cle,$pub){
        $db=new Database();
        $sql = "UPDATE ratings SET `scopus`='$scopus',`clarivate`='$cle',`pubmed`='$pub' WHERE resID='$this->resID'";

        $query=$db->db_query($sql);
        $db->db_close();
    }
    public static function selectAll(){
        $db=new Database();
        $sql = "select * from ratings";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Ratings($row['resID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }
    public static function selectByResID($resID){
        $db=new Database();
        $sql = "SELECT * FROM ratings WHERE resID='$resID'";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Ratings($row['resID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }

    /**
     * @return mixed
     */
    public function getResID(): mixed
    {
        return $this->resID;
    }

    /**
     * @return mixed
     */
    public function getScopus(): mixed
    {
        return $this->scopus;
    }

    /**
     * @return mixed
     */
    public function getClarivate(): mixed
    {
        return $this->clarivate;
    }

    /**
     * @return mixed
     */
    public function getPubmed(): mixed
    {
        return $this->pubmed;
    }

    /**
     * @return mixed
     */
    public function getForeignResearcher(): mixed
    {
        return $this->foreign_researcher;
    }

    /**
     * @return mixed
     */
    public function getMultipleUniversities(): mixed
    {
        return $this->multiple_universities;
    }

    /**
     * @return mixed
     */
    public function getUniversityName(): mixed
    {
        return $this->university_name;
    }


}
//$r=new Ratings(0);
//$r->insert(203,"Q3",0,0,1,0,"mutah");
//$x=Ratings::selectByResID(542);
//print_r(x);