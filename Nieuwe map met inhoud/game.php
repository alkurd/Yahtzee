<?php
$modeKey = $_POST['mode'] ?? 'ai';
$mode = $_SESSION[$modeKey] ?? null;?>

<form style="text-align:center" method="GET">
    <select  name="mode" onchange="this.form.submit()">
        <option value="">-- Maak een keuze --</option>
        <option value="ai">Tegen de computer</option>
        <option value="local">Multiplayer</option>
    </select>
    </form>
<?php
if ($modeKey === 'ai') { ?>
    <form type="hidden" method="post">
        <label>Jouw naam is?</label>
        <input type="text" name="player0">
        <input type="submit" value="spel starten">
    </form>

<?php } elseif ($modeKey === 'local') {
    echo 'multiplayer';
}

