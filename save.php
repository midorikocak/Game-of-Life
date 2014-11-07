<?php
$myfile = fopen("out.xml", "w") or die("Unable to open file!");

$doc = new DOMDocument( "1.0", "UTF-8" );
$doc->formatOutput = true;

$life = $doc->createElement( "life" );
$doc->appendChild( $life );

$world = $doc->createElement( "world" );
$life->appendChild( $world );

$cells = $doc->createElement( "cells", $_POST['cells'] );
$world->appendChild($cells);

$species = $doc->createElement( "species", $_POST['species'] );
$world->appendChild($species);

$iterations = $doc->createElement( "iterations", $_POST['iterations'] );
$world->appendChild($iterations);

$x = 0;
$y = 0;

$organisms = $doc->createElement( "organisms" );
$life->appendChild( $organisms );
$squares = json_decode($_POST['result']);
for($x = 0; $x<$_POST['cells'];$x++){
    for($y=0;$y<$_POST['cells'];$y++){
        if($squares[$x][$y]!=0)
        {
            $organism = $doc->createElement( "organism" );
            $organisms->appendChild( $organism );
         
            $x_pos = $doc->createElement( "x_pos", $x );
            $organism->appendChild($x_pos);
         
            $y_pos = $doc->createElement( "y_pos", $y );
            $organism->appendChild($y_pos);
         
            $elementSpecies = $doc->createElement( "species", $squares[$x][$y] );
            $organism->appendChild($elementSpecies);
        }
    }
}
fwrite($myfile, $doc->saveXML());

fclose($myfile);
session_destroy();
?>