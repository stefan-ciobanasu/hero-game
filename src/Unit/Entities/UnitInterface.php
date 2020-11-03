<?php
namespace Unit\Entities;

use Skills\Entities\SkillCollection;

interface UnitInterface
{
    /**
     * @return mixed
     */
    public function getHealth();

    /**
     * @param int $health
     * @return UnitInterface
     */
    public function setHealth(int $health);

    /**
     * @return int
     */
    public function getStrength();

    /**
     * @return int
     */
    public function getDefence();

    /**
     * @return int
     */
    public function getSpeed();

    /**
     * @return int
     */
    public function getLuck();

    /**
     * @return SkillCollection
     */
    public function getSkills();

    /**
     * @param SkillCollection $skills
     * @return UnitInterface
     */
    public function setSkills(SkillCollection $skills);
}