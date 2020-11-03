<?php
namespace Combat;

use Combat\Models\Logger;
use Combat\Models\Strike;
use Unit\Entities\UnitInterface;

class StrikeBuilder
{
    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     * @param Logger $logger
     * @return Strike
     */
    public static function createNewStrike(UnitInterface $attacker, UnitInterface $defender, Logger $logger)
    {
        return new Strike($attacker, $defender, $logger);
    }
}