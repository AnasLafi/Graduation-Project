<?php
require_once ('Connection.php');
//require 'authors.php';
class AmountDue  extends Database
{
    private $resID;
    private $numberOfAuthors;
    private $amount;
    private $amountPerResearcher;


    public function __construct($resID)
    {
        $db=new Database();
        if ($resID !="") {
            $select="SELECT * FROM amount_due WHERE resID='$resID'";
            $query=$db->db_query($select);
            if ($db->db_num($select) > 0) {
                while($row = mysqli_fetch_array($query)) {

                    $this->resID=$row['resID'];
                    $this->numberOfAuthors=$row['number_authors'];
                    $this->amount=$row['amount'];
                    $this->amountPerResearcher=$row['amount_per_researcher'];



                }
            }
            else {
                $this->resID=$resID ;
            }

        }
        $db->db_close();
    }
    public static function selectAll(){
        $db=new Database();
        $sql = "select * from amount_due";
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
    public static function selectByResID($resID){
        $db=new Database();
        $sql = "SELECT * FROM amount_due WHERE resID='$resID'";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new AmountDue($row['resID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        }
        $db->db_close();
        return $result;//return array of objects


    }
    public static function Delete($resID){
        $db=new Database();
        $sql = "DELETE FROM amount_due WHERE resID=$resID";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public function insert($resID,$numberOfAuthors,$amount,$amountPerRes){
        $db=new Database();
        $sql = "INSERT INTO amount_due VALUES ('$resID','$numberOfAuthors','$amount','$amountPerRes')";
        $query=$db->db_query($sql);
        $db->db_close();
    }
    public function update($amount,$amountPerRes){
        $db=new Database();
        $sql = "UPDATE `amount_due` SET `amount`='$amount',`amount_per_researcher`='$amountPerRes' WHERE resID='$this->resID'";
        $query=$db->db_query($sql);
        $db->db_close();
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
    public function getNumberOfAuthors(): mixed
    {
        return $this->numberOfAuthors;
    }

    /**
     * @param mixed $numberOfAuthors
     */
    public function setNumberOfAuthors(mixed $numberOfAuthors): void
    {
        $this->numberOfAuthors = $numberOfAuthors;
    }

    /**
     * @return mixed
     */
    public function getAmount(): mixed
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount(mixed $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmountPerResearcher(): mixed
    {
        return $this->amountPerResearcher;
    }

    /**
     * @param mixed $amountPerResearcher
     */
    public function setAmountPerResearcher(mixed $amountPerResearcher): void
    {
        $this->amountPerResearcher = $amountPerResearcher;
    }


}
//$amount=new AmountDue(0);
//$amount->insert(391,1,1200,1200);
//
//$auth=Authors::selectByResID(391);
//echo count($auth);