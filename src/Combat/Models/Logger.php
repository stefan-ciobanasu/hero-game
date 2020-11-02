<?php
namespace Combat\Models;

use Unit\Entities\UnitInterface;

class Logger
{
    /**
     * @var
     */
    protected $combatLog = '';

    /**
     * @param $message
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    public function pushToCombatLog($message, $attacker, $defender)
    {
        if (method_exists($attacker, 'getName')) {
            $attackerName = $attacker->getName();
        } else {
            $attackerName = "Wild Beast";
        }
        if (method_exists($defender, 'getName')) {
            $defenderName = $defender->getName();
        } else {
            $defenderName = "Wild Beast";
        }
        $message = str_replace('{attacker}', $attackerName, $message);
        $message = str_replace('{defender}', $defenderName, $message);
        $this->combatLog .= $message;
    }

    public function getCombatLog()
    {
        return $this->combatLog;
    }
}

