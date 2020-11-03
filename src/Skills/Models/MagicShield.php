<?php
namespace Spells\Models;

use Combat\Entities\StrikeInterface;
use Skills\Entities\SkillBase;
use Skills\Entities\SkillTiming;
use Skills\Entities\SkillTraits;
use Skills\Entities\SkillType;

final class MagicShield extends SkillBase
{
    use SkillTraits;
    public function __construct()
    {
        $this->name = 'Magic Shield';
        $this->description = 'Gives a 20% chance that the defender will take only half the damage from an attack.';
        $this->activationChance = 20;
        $this->timing = SkillTiming::PRE_STRIKE;
        $this->type = SkillType::DEFENSIVE;
    }

    public function applySkillEffects(StrikeInterface $strike)
    {
        if ($this->skillActivates($this->getActivationChance())) {
            $strike->getLogger()->pushToCombatLog(
                'Magic Shield skill activates for {defender} reducing incoming damage by 50%.<br/>',
                $strike->getAttacker(),
                $strike->getDefender()
            );
            $strike->setPercentageDamageReduction(0.5);
        }
        return $this;
    }
}