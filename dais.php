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

function calculaatScore($categories, $dais){
    $counts= array_count_values($dais);
    switch($categories){
        case "ones":return ($counts[1] ?? 0) * 1;
        case "twos":return ($counts[2] ?? 0) * 2;
        case "threes":return ($counts[3] ?? 0) * 3;
        case "fours":return ($counts[4] ?? 0) * 4;
        case "fives":return ($counts[5] ?? 0) * 5;
        case "sixes":return ($counts[6] ?? 0) * 6;
        case "three_kind":
            foreach($counts as $n) if($n >= 3)return array_sum($n);
            return 0;
        case "four_kind":
            foreach($counts as $n)  if( $n >= 4)return array_sum($n);
            return 0;
        case "full_house":
            if(in_array(3, $counts) && in_array(2, $counts)) return 25;
            return 0;
        case "small_straight":
            $straight =[
                [1,2,3,4],
                [2,3,4,5],
                [3,4,5,6]
            ];
            foreach($straight as $n) if( $dais === $n) return 30;
            return 0;
        case "large_straight":
            $straight=[
                [1,2,3,4,5],
                [2,3,4,5,6],
            ];
            foreach($counts as $n) if( $dais === $n) return 40;
            return 0;
        case "yahzee":
            if(count($counts) ===1 ) return 50;
            return 0;   
        case "chance":
            return array_sum($counts);
        default:
            return 0;
        
    }
}
?>


