<?php
namespace Spells\Models;

use Combat\Entities\StrikeInterface;
use Combat\StrikeBuilder;
use Skills\Entities\Skill;
use Skills\Entities\SkillTiming;
use Skills\Entities\SkillType;

final class RapidStrike extends Skill
{
    public function __construct()
    {
        $this->name = 'Rapid Strike';
        $this->description = 'Gives a 10% chance that the attacker will strike twice in rapid succession.';
        $this->activationChance = 10;
        $this->timing = SkillTiming::POST_STRIKE;
        $this->type = SkillType::OFFENSIVE;
    }

    public function applySkillEffects(StrikeInterface $strike)
    {
        if ($this->skillActivates()) {
            $strike->getLogger()->pushToCombatLog(
                'Rapid Strike skill activates for {attacker} allowing them a second hit.<br/>',
                $strike->getAttacker(),
                $strike->getDefender()
            );
            $strike->getAttacker()->setSkills($strike->getAttacker()->getSkills()->removeSkillByName('Rapid Strike'));
            $newStrike = StrikeBuilder::createNewStrike($strike->getAttacker(), $strike->getDefender(), $strike->getLogger());
            $newStrike->resolveStrike();
            $strike->getAttacker()->setSkills($strike->getAttacker()->getSkills()->addSkill($this));
        }
        return $this;
    }
}