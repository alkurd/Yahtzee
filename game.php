<?php
session_start();
require_once 'functions.php';

$mode = $_GET['mode']?? null;
if ($mode== 'local'){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $aantalplayers = (int)($_POST['players']?? 0);
        if($aantalplayers < 1 || $aantalplayers > 4){
            echo"<p style='color:red'>❌ ongeldig aantal spelers, kies tussen 1 en 4</p>";
        }else{
            echo"<p>✅spel is gestart met $aantalplayers speler(s).</p>";
        }
}else{
    ?>
    <form method='POST'>
        <label>hoeveel spelers? (max 4):</label>
        <input type="number" mix="1" max="4" name="spelers" id="spelers" requird>
    </form>
    <?php
    }
} elseif ($mode === 'ai') {
    echo "<p>🎮 Spel gestart tegen de computer!</p>";
    // Start hier je AI-spel
} else {
    echo "<p>⚠️ Ongeldige spelmodus gekozen.</p>";
}

?>