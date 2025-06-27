<?php
// session_start();

// $mode = $_SESSION['mode'] ?? null;
$spelers = $_SESSION['spelers'] ?? ['Jij', 'Computer'];
$scores = $_SESSION['scores'] ?? [];
$totalScore =

$categories = [
    'upper' => [
        'ones' => 'Ones',
        'twos' => 'Twos',
        'threes' => 'Threes',
        'fours' => 'Fours',
        'fives' => 'Fives',
        'sixes' => 'Sixes',
    ],
    'lower' => [
        'three_kind' => 'Three of a Kind',
        'four_kind' => 'Four of a Kind',
        'full_house' => 'Full House',
        'small_straight' => 'Small Straight',
        'large_straight' => 'Large Straight',
        'yahtzee' => 'Yahtzee',
        'chance' => 'Chance',
    ]
];

function table($categories, $spelers, $scores, $total=[]){?>
     <tbody>
            <?php foreach($categories as $key => $label): ?>
                
                <tr>
                    <td><?=htmlspecialchars($label)?></td>
                    <?php foreach($spelers as $speler): ?>
                    <td><?= htmlspecialchars($scores[$speler][$label] ?? '-') ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            <tr>
            <th><strong>Totaal <?=$total?></strong></th>
            <?php foreach($spelers as $speler):?> 
                <td><?=htmlspecialchars($total ?? '-') ?></td>
                <?php endforeach ?>
            </tr>

        </tbody>
<?php } ?>


<aside calss='scorebord'>
    <h3>Scorebord mode (<?=htmlspecialchars($mode)?>)</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Categories</th>
                <?php foreach($spelers as $speler): ?>
                    <th><?=htmlspecialchars($speler)?></th>
                    <?php endforeach ?>
            </tr>
        </thead>
       <?php table($categories['upper'], $spelers, $scores, "boven");
       table($categories['lower'], $spelers, $scores,"onder");?>

    </table>
</aside>

<?php





