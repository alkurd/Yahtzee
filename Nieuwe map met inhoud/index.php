<?php 
session_start();
$mode = $_GET['mode']?? 'ai';
if ($mode=== 'local' && !empty($_POST['spelersname'])) {
    $_SESSION['spelers'] = $_POST['spelersname'];
}elseif ($mode=== 'ai' && !empty($_POST['player0'])) {
    $_SESSION['spelers'] = [$_POST['player0'], 'Computer'];
}


// $gekozen = $_POST['aantalspelers'] ?? 1;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Yahtzee</title>
</head>
<body>
    <header><h1 style="text-align:center; background-color:gray">Yahtzee</h1></header>
<?php require 'scorebord.php';?>
    <!-- Dropdown menu -->

    <form style="text-align:center" method="GET">
        <label for="mode">Kies een spelmodus:</label>
        <select name="mode" id="mode" onchange="this.form.submit()">
            <option value="">-- Maak een keuze --</option>
            <option value="ai" <?= $mode === 'ai' ? 'selected' : '' ?>>Tegen de computer</option>
            <option value="local" <?= $mode === 'local' ? 'selected' : '' ?>>Multiplayer</option>
        </select>
    </form>

    <main style="text-align:center">
        <?php if ($mode === 'ai'): ?>
            <form method="POST">
                <label>Jouw naam is?</label>
                <input type="text" name="player0" required>
                <input type="submit" value="Spel starten">
            </form>
        <?php elseif ($mode === 'local'): ?>
            <?php
// Aantal spelers uit POST ophalen of standaard 1
$gekozen = $_POST['aantalspelers'] ?? 1;
?>

<form method="POST">
    <label for="aantalspelers">Aantal spelers:</label>
    <select name="aantalspelers" id="aantalspelers" onchange="this.form.submit()">
        <?php
        for ($i = 1; $i <= 4; $i++) {
            $selected = ($gekozen == $i) ? 'selected' : '';
            echo "<option value=\"$i\" $selected>$i speler" . ($i > 1 ? "s" : "") . "</option>";
        }
        ?>
    </select>

    <br><br>

    <?php
    // Toon naamvelden met foreach
    
    for ($j = 1; $j <= $gekozen; $j++) {
        echo "<label for='speler$j'>Naam speler $j:</label>";
        echo "<input type='text' name='spelersname[]' id='speler$j'><br>";
    }
    ?>
    <br>
    <!-- <input type="hidden" name="mode" value="local"> -->
    <input type="submit" value="Start spel">
</form>
        <?php endif; ?>
    </main>

    <hr>
    <footer style="text-align:center">&copy; Yousef <?= date("Y"); ?></footer>
</body>
</html>