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
