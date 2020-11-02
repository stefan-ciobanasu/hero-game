<?php
namespace Combat\Models;

use Combat\Entities\StrikeInterface;
use Skills\Entities\SkillCollection;
use Skills\Entities\SkillTiming;
use Skills\Entities\SkillType;
use Unit\Entities\UnitInterface;

class Strike implements StrikeInterface
{
    /** @var UnitInterface */
    protected $attacker;
    /** @var UnitInterface */
    protected $defender;
    /** @var int */
    protected $addedFlatStrength = 0;
    /** @var int */
    protected $strengthMultiplier = 1;
    /** @var int */
    protected $addedFlatDefense = 0;
    /** @var int */
    protected $defenseMultiplier = 1;
    /** @var int */
    protected $percentageDamageReduction = 0;
    /** @var int */
    protected $flatDamageReduction = 0;
    /** @var SkillCollection */
    protected $skillCollection;
    /** @var int */
    protected $damageDone;
    /** @var Logger */
    protected $logger = '';
    public function __construct(
        UnitInterface $attacker,
        UnitInterface $defender,
        Logger $logger
    )
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
        $this->logger = $logger;
    }

    public function resolveStrike()
    {
        $this->collectSkills();
        $this->applyPreStrikeSkills();
        $this->calculateCombatValues();
        $this->applyPostStrikeSkills();
    }

    public function getAttacker()
    {
        return $this->attacker;
    }

    public function getDefender()
    {
        return $this->defender;
    }

    protected function collectSkills()
    {
        $skillCollection = [];
        if (!empty($this->getAttacker()->getSkills())) {
            $skillCollection += $this->getAttacker()->getSkills()->getSkillsByType(SkillType::OFFENSIVE);
        }
        if (!empty($this->getDefender()->getSkills())) {
            $skillCollection +=$this->getDefender()->getSkills()->getSkillsByType(SkillType::DEFENSIVE);
        }
        $this->setSkillCollection(new SkillCollection($skillCollection));
        return $this;
    }

    protected function applyPreStrikeSkills()
    {
        $preStrikeSkills = $this->getSkillCollection()->getSkillsByTiming(SkillTiming::PRE_STRIKE);
        foreach ($preStrikeSkills as $skill) {
            $skill->applySkillEffects($this);
        }
        return $this;
    }

    protected function calculateCombatValues()
    {
        $strength = intval($this->getAttacker()->getStrength() * $this->getStrengthMultiplier()) + $this->getAddedFlatStrength();
        $defense = intval($this->getDefender()->getDefence() * $this->getDefenseMultiplier()) + $this->getAddedFlatDefense();
        $this->damageDone = intval(($strength - $defense - $this->getFlatDamageReduction()) * (1 - $this->getPercentageDamageReduction()));
        $this->getDefender()->setHealth($this->getDefender()->getHealth() - $this->getDamageDone());
        $this->getLogger()->pushToCombatLog(
            "{attacker} strikes {defender} for " . $this->getDamageDone() . " points of damage, dropping their hit points to " . $this->getDefender()->getHealth() . "<br/>",
            $this->getAttacker(),
            $this->getDefender()
        );
        return $this;
    }

    protected function applyPostStrikeSkills()
    {
        $postStrikeSkills = $this->getSkillCollection()->getSkillsByTiming(SkillTiming::POST_STRIKE);
        foreach ($postStrikeSkills as $skill) {
            $skill->applySkillEffects($this);
        }
        return $this;
    }

    /**
     * @return int
     */
    public function getAddedFlatStrength()
    {
        return $this->addedFlatStrength;
    }

    /**
     * @param int $addedFlatStrength
     * @return Strike
     */
    public function setAddedFlatStrength($addedFlatStrength)
    {
        $this->addedFlatStrength = $addedFlatStrength;
        return $this;
    }

    /**
     * @return int
     */
    public function getStrengthMultiplier()
    {
        return $this->strengthMultiplier;
    }

    /**
     * @param int $strengthMultiplier
     * @return Strike
     */
    public function setStrengthMultiplier($strengthMultiplier)
    {
        $this->strengthMultiplier = $strengthMultiplier;
        return $this;
    }

    /**
     * @return int
     */
    public function getAddedFlatDefense()
    {
        return $this->addedFlatDefense;
    }

    /**
     * @param int $addedFlatDefense
     * @return Strike
     */
    public function setAddedFlatDefense($addedFlatDefense)
    {
        $this->addedFlatDefense = $addedFlatDefense;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefenseMultiplier()
    {
        return $this->defenseMultiplier;
    }

    /**
     * @param int $defenseMultiplier
     * @return Strike
     */
    public function setDefenseMultiplier($defenseMultiplier)
    {
        $this->defenseMultiplier = $defenseMultiplier;
        return $this;
    }

    /**
     * @return int
     */
    public function getPercentageDamageReduction()
    {
        return $this->percentageDamageReduction;
    }

    /**
     * @param int $percentageDamageReduction
     * @return Strike
     */
    public function setPercentageDamageReduction($percentageDamageReduction)
    {
        $this->percentageDamageReduction = $percentageDamageReduction;
        return $this;
    }

    /**
     * @return int
     */
    public function getFlatDamageReduction()
    {
        return $this->flatDamageReduction;
    }

    /**
     * @param int $flatDamageReduction
     * @return Strike
     */
    public function setFlatDamageReduction($flatDamageReduction)
    {
        $this->flatDamageReduction = $flatDamageReduction;
        return $this;
    }

    /**
     * @return SkillCollection
     */
    public function getSkillCollection()
    {
        return $this->skillCollection;
    }

    /**
     * @param SkillCollection $skillCollection
     * @return Strike
     */
    public function setSkillCollection($skillCollection)
    {
        $this->skillCollection = $skillCollection;
        return $this;
    }

    /**
     * @return int
     */
    public function getDamageDone()
    {
        return $this->damageDone;
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }
}