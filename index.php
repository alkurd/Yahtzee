<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yehtzee scoreblad</title>
</head>
<body>
        <form action="game.php" method="GET">
            <button type="submit" name="mode" id="mode" value="ai">Tegen de computer</button>
            <button type="submit" name="mode" id="mode" value="local">Tegen andere spellers</button>
        </form>
        <?php if ($mode=['local']){
            
        }
        ?>
</body>
</html>