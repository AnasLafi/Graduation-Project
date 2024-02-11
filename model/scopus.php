<?php
require_once ('../model/Connection.php');
class Scopus extends Database
{
    private $Rank="";
    private $Title="";
    private $Type="";
    private $Issn1="";
    private $Issn2="";
    private $Issn3="";
    private $SJR="";
    private $Quartile="";
    private $found=false;
    public function __construct($Issn1)
    {
        if ($Issn1!=" ")
            $this->select($Issn1);
        else
            $this->Quartile = '-';
//        if ($Issn1 != "" && $Issn2 != ""&&$this->found == false)
//            $this->select($Issn2);
    }
    public function select($Issn1){
        $db = new Database();
            $sql = "SELECT Rank, Title, Type, Issn1, Issn2, Issn3, SJR, Quartile FROM scopus_1 WHERE Issn1='$Issn1'";
            $query = $db->db_query($sql);
            if ($db->db_num($sql) > 0) {
                $this->found=true;
                while ($row = mysqli_fetch_array($query)) {
                    $this->Rank = $row['Rank'];
                    $this->Title = $row["Title"];
                    $this->Type = $row['Type'];
                    $this->Issn1 = $row['Issn1'];
                    $this->Issn2 = $row['Issn2'];
                    $this->Issn3 = $row['Issn3'];
                    $this->SJR = $row['SJR'];
                    $this->Quartile = $row['Quartile'];
//                    echo 'found in issn1<br>';

                }
            } else {
                $sql = "SELECT Rank, Title, Type, Issn1, Issn2, Issn3, SJR, Quartile FROM scopus_1 WHERE Issn2='$Issn1'";
                $query = $db->db_query($sql);
                if ($db->db_num($sql) > 0) {
                    $this->found=true;
                    while ($row = mysqli_fetch_array($query)) {
                        $this->Rank = $row['Rank'];
                        $this->Title = $row["Title"];
                        $this->Type = $row['Type'];
                        $this->Issn1 = $row['Issn1'];
                        $this->Issn2 = $row['Issn2'];
                        $this->Issn3 = $row['Issn3'];
                        $this->SJR = $row['SJR'];
                        $this->Quartile = $row['Quartile'];
//                        echo 'found in issn2<br>';


                    }
                } else {
                    $sql = "SELECT Rank, Title, Type, Issn1, Issn2, Issn3, SJR, Quartile FROM scopus_1 WHERE Issn3='$Issn1'";
                    $query = $db->db_query($sql);
                    if ($db->db_num($sql) > 0) {
                        $this->found=true;
                        while ($row = mysqli_fetch_array($query)) {
                            $this->Rank = $row['Rank'];
                            $this->Title = $row["Title"];
                            $this->Type = $row['Type'];
                            $this->Issn1 = $row['Issn1'];
                            $this->Issn2 = $row['Issn2'];
                            $this->Issn3 = $row['Issn3'];
                            $this->SJR = $row['SJR'];
                            $this->Quartile = $row['Quartile'];

                            echo 'found in issn3'."<br>";

                        }
                    }

                }
                $db->db_close();
            }

    }
    public static function selectAll(){
        $db=new Database();
        $sql = "select * from authors";
        $query =$db->db_query($sql);
        $result=array();
        $i=0;
        if ($db->db_num($sql) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($query)) {
                $myobj=new Authors($row['authID']);
                $result[$i]=$myobj;//store each row in object
                $i++;
            }
        } else {
            echo "0 results";
        }
        $db->db_close();
        return $result;//return array of objects


    }

    /**
     * @return bool
     */
    public function isFound(): bool
    {
        return $this->found;
    }
    /**
     * @return mixed
     */
    public function getRank(): mixed
    {
        return $this->Rank;
    }

    /**
     * @return mixed
     */
    public function getTitle(): mixed
    {
        return $this->Title;
    }

    /**
     * @return mixed
     */
    public function getType(): mixed
    {
        return $this->Type;
    }

    /**
     * @return mixed
     */
    public function getIssn1(): mixed
    {
        return $this->Issn1;
    }

    /**
     * @return mixed
     */
    public function getIssn2(): mixed
    {
        return $this->Issn2;
    }

    /**
     * @return mixed
     */
    public function getIssn3(): mixed
    {
        return $this->Issn3;
    }

    /**
     * @return mixed
     */
    public function getSJR(): mixed
    {
        return $this->SJR;
    }

    /**
     * @return mixed
     */
    public function getQuartile(): mixed
    {
        return $this->Quartile;
    }

}
//$n=new Scopus("1471-0080");
//echo $n->getIssn1()."<br>";
//echo $n->getIssn2()."<br>";
//echo $n->getIssn3()."<br>";
//echo $n->getType()."<br>";
//echo $n->getTitle()."<br>";
//
//echo $n->getQuartile()."<br>";
//echo $n->isFound()."<br>";

//echo "/<pre>";