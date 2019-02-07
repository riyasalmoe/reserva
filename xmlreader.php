<?php

include('./general.php');
//xmlreader_method('./xml/AlAwir.xml');
// $a = array();
// $a = read_resources();
// echo "Length of Array: " . count($a);
// print_r($a);

function xmlreader_getMeetings($thisFileName) {



$reader = new XMLReader();

$doc = new DOMDocument;

// read file external xml file...
if(!file_exists($thisFileName)){return;}

if (!$reader->open($thisFileName)) {
    //return;
    die("Failed to open $thisFileName");
}

// reading xml data...
while($reader->read()) {
  if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'event') {
  
    $node = simplexml_import_dom($doc->importNode($reader->expand(), true));
   
    //check for today's entries and skip the rest
    if(!(return_DateOnlyStd($node->start_time) === date('d-M-Y'))){continue;} 
    
    //only of test specific room
    //if(!(($node->id) == 'Al Awir')){continue;} 

    echo "<tr id='data'>";
        echo "<td class='tdstyle text-left'>";
        //echo $eventid = $reader->getAttribute('uid');
        echo return_DateTimeStd($node->start_time);
        echo "</td>";
        echo "<td class='tdstyle text-center'>";
        echo $node->subject;
        echo "</td class='tdstyle'>";
        echo "<td class='tdstyle text-right'>";
        echo $node->id;
        echo "</td>";
    echo "</tr>";
    
   }
}
$reader->close();

}
//-----------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------//
function read_resources($thisFloor)
{
    $thisFileName = "xml/rooms.xml";

    $rooms = array();

    $reader = new XMLReader();

    $doc = new DOMDocument;

// read file external xml file...

    if (!$reader->open($thisFileName)) {
        die("Failed to open $thisFileName");
    }

// reading xml data...
    while ($reader->read()) {
        if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'room') {

            $node = simplexml_import_dom($doc->importNode($reader->expand(), true));

            if(!($node->floor == $thisFloor)){continue;}

            array_push($rooms,$node->uid);

        }
    }
    $reader->close();

    return $rooms;
  }

//-----------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------//