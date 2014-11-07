<?php
session_start();
if(isset($_FILES))
{

    $file = $_FILES['file'];
    $allowedExts = array("xml");
    $temp = explode(".", $file["name"]);
    $extension = end($temp);
    if (
    (($file["type"] == "application/xml") || ($file["type"] == "text/xml"))
            && ($file["size"] < 2000000)
                && $extension =="xml"
    ) {
        if ($file["error"] > 0) {
            return false;
        } else {

            if( move_uploaded_file($file["tmp_name"],
            dirname(__FILE__).'/'.$file["name"])){
                chmod($file["name"], 0777);
                $life = simplexml_load_file( "out.xml", "SimpleXMLElement",
                 LIBXML_NOCDATA );

                 $cells = (int)$life->world->cells;
                 $species = (int)$life->world->species;
                 $iterations = (int)$life->world->iterations;
                 
                 $squares = array();
                 for($i=0;$i<$cells;$i++){
                     $squares[$i] = array_fill(0, (int)$cells, 0);
                 }
                 
                 foreach($life->organisms->organism as $organism){
                     $squares[(int)$organism->x_pos][(int)$organism->y_pos]=(int)$organism->species;
                 }
                 
                 $_SESSION['cells'] = $cells;
                 $_SESSION['species'] = $species;
                 $_SESSION['iterations']= $iterations;
                 $_SESSION['squares'] = json_encode($squares);
                 //var_dump($_SESSION);
                  header('Location:life.php');
                }
                  
        }
    } else {
        return "Invalid file";
    }
}

?>            