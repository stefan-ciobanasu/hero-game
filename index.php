<?php

use Unit\Builders\HeroBuilder;
use Unit\Builders\MonsterBuilder;

require_once __DIR__.'/vendor/autoload.php';

$fight = $_REQUEST['fight'];
$contents = '';

if (isset($fight) && $fight == 'Yes'){
    $combatRunner = new \Combat\CombatRunner();
    $hero = HeroBuilder::build();
    $monster = MonsterBuilder::build();
    $combatRunner->runSimulation($hero, $monster);
}
?>
<body>
<form action="" method="get">
    <?php if (isset($fight) && $fight == 'Yes'){
        echo "<br/>Re-";
    }?>Run the combat simulation?
    <input type="submit" name="fight" value="Yes">
</form>
</body>
