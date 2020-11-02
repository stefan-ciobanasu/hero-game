<?php
namespace Skills\Entities;

use Combat\Entities\StrikeInterface;

abstract class Skill
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var int
     */
    protected $activationChance;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $timing;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @return int
     */
    public function getActivationChance()
    {
        return $this->activationChance;
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTiming()
    {
        return $this->timing;
    }

    /**
     * @param StrikeInterface $strike
     */
    public function applySkillEffects(StrikeInterface $strike) {}

    /**
     * @return bool
     */
    protected function skillActivates()
    {
        return (mt_rand(0,100) < $this->getActivationChance());
    }
}