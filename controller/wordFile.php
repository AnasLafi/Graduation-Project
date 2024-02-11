<?php

// Include the PHPWord library
require_once '../model/Research.php';
require_once '../model/AmountDue.php';
require_once '../model/Ratings.php';

require_once '../model/login.php';
require_once '../public/vendor/autoload.php';
//$id = intval($_GET['id']);
//$resID = intval($_GET['resID']);
//echo $id."<br>";
//echo $resID."<br>";
function GenerateWordFile($id,$resID)
{
    $user = User::select($id);
//echo $user->get_email()."<br>";

    $amount = new AmountDue($resID);
    $res = new Research($resID);
    $rating = new Ratings($resID);


// Create a new PHPWord object
    $phpWord = new \PhpOffice\PhpWord\PhpWord();

// Add a new section to the document
    $section = $phpWord->addSection();

// Add a table to the document
    $phpWord->addTableStyle('myTable',
        array('borderColor' => '006699',
            'borderSize' => 6,
            'cellMargin' => 50)
    );

// Add a table
    $table = $section->addTable('myTable');

    $table->addRow();

// Add cells to the row and add text to the cells
    $table->addCell(1750,)->addText('ID');
    $table->addCell(1750)->addText('research ID');
    $table->addCell(1750)->addText('Journal');
    $table->addCell(6550)->addText('Title');
    $table->addCell(1750)->addText('ISSN');
    $table->addCell(1750)->addText('total amount');
    $table->addCell(1750)->addText('Deserved amount');
    $table->addCell(1750)->addText('Number of authors');
    $table->addCell(1750)->addText('Scopus');
    $table->addCell(1750)->addText('Clarivate');


// Add some rows to the table

    $table->addRow();

    $table->addCell(1750)->addText($res->getAuthID());
    $table->addCell(1750)->addText($res->getId());
    $table->addCell(1750)->addText($res->getJournal());
    $table->addCell(6550)->addText($res->getTittle());
    $table->addCell(1750)->addText($res->getISSN());
    $table->addCell(1750)->addText($amount->getAmount());
    $table->addCell(1750)->addText($amount->getAmountPerResearcher());
    $table->addCell(1750)->addText($amount->getNumberOfAuthors());
    $table->addCell(1750)->addText($rating->getScopus());
    if ($rating->getClarivate() == 1)
        $table->addCell(1750)->addText("Yes");


    else
        $table->addCell(1750)->addText("NO");


// Save the document as a Word file
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//$objWriter->save('table.docx');
    $objWriter->save('../public/docsFiles/' . $res->getAuthID() . '-'.$res->getId().'.docx');
}