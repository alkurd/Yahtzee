<?php
session_start();

// Initieer als keep-array nog niet bestaat
if (!isset($_SESSION["keep"])) {
    $_SESSION["keep"] = [];
}

$rollsLeft = 3;

// Verwerk formulier als het is verzonden
// Haal de keep-array op uit het formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION["keep"] = isset($_POST["keep"]) ? $_POST["keep"] : [];
    $rollsLeft = $_POST['rollsLeft'] - 1; // verminder worpen
}

// Genereer de dobbelstenen
// Als deze NIET vastgehouden wordt, gooi hem opnieuw
// Als wel vastgehouden, bewaar vorige waarde of stel een dummy in
$dias = [];
for ($i = 0; $i < 5; $i++) {
    if (!in_array($i, $_SESSION["keep"])) {
        $dias[$i] = rand(1, 6);
    } else {
        $dias[$i] = isset($_SESSION["dice"][$i]) ? $_SESSION["dice"][$i] : 1;
    }
}

$_SESSION["dice"] = $dias;
// Sla de nieuwe waarden op
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dobbelstenen Gooien</title>
</head>
<body>
    <h2>Dobbelstenen</h2>

    <form method="post">
        <?php foreach ($dias as $index => $waarde): ?>
            <label>
                <input type="checkbox" name="keep[]" value="<?= $index ?>"
                    <?= in_array($index, $_SESSION["keep"]) ? "checked" : "" ?>>
                Dobbelsteen <?= $index + 1 ?>: <?= $waarde ?>
            </label><br>
        <?php endforeach; ?>

        <input type="hidden" name="rollsLeft" value="<?= $rollsLeft ?>">

        <p>Worpen over: <?= $rollsLeft ?></p>

        <button type="submit" <?= $rollsLeft <= 0 ? "disabled" : "" ?>>Gooi opnieuw</button>
    </form>

    <form method="post">
        <input type="hidden" name="reset" value="1">
        <button type="submit">Reset spel</button>
    </form>

    <?php
    // Reset logica
    if (isset($_POST["reset"])) {
        session_destroy();
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    }
    ?>
</body>
</html>
