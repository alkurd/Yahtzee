<?php
session_start();

if (!isset($_SESSION["keep"])){
    $_SESSION["keep"] = [];
}
$rollsLeft = 3;
if ($_SERVER["REQUEST_METHOD"]==="POST"){
    $_SESSION["keep"]= isset($_POST["keep"]) ? $_POST["keep"] :[];
    $rollsLeft = $_POST['rollsLeft'] -1;
}
$dais= [];
for($i = 0 ; $i <5 ;$i++){
    if(!in_array($i, $_SESSION['keep'])){
        $dais[$i] = rand(1,6);
    }else{
        $dais[$i] = isset($_SESSION["dais"][$i]) ? $_SESSION["dais"][$i] : 1;
    }
}
$_SESSION["dais"] = $dais;
?>


