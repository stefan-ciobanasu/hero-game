<?php
namespace Unit\Models;

use Skills\Entities\SkillCollection;
use Unit\Entities\UnitInterface;

class Hero implements UnitInterface
{
    protected $name = "Orderus";
    /**
     * @var int $health
     */
    protected $health;
    /**
     * @var int $strength
     */
    protected $strength;
    /**
     * @var int $defence
     */
    protected $defence;
    /**
     * @var int $speed
     */
    protected $speed;
    /**
     * @var int $luck
     */
    protected $luck;
    /**
     * @var SkillCollection
     */
    protected $skills;

    public function __construct(
        $health,
        $strength,
        $defence,
        $speed,
        $luck,
        $skills
    )
    {
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
        $this->skills = $skills;
    }

    /**
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @return Hero
     */
    public function setHealth($health)
    {
        $this->health = $health;
        return $this;
    }

    /**
     * @return int
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @return SkillCollection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param SkillCollection $skills
     * @return UnitInterface
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}