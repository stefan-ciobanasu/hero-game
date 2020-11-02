<?php

require_once __DIR__.'/vendor/autoload.php';

$fight = $_REQUEST['fight'];
$contents = '';

if (isset($fight) && $fight == 'Yes'){
    $combatRunner = new \Combat\CombatRunner();
    $combatRunner->runSimulation();
}
?>
<body>
<form action="" method="get">
    <?php if (isset($fight) && $fight == 'true'){
        echo "Re-";
    }?>Run the combat simulation?
    <input type="submit" name="fight" value="Yes">
</form>
</body>
