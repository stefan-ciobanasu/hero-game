<?php
namespace Skills\Entities;

use Combat\Entities\StrikeInterface;

interface Skill
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return int
     */
    public function getActivationChance();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getTiming();

    /**
     * @param StrikeInterface $strike
     */
    public function applySkillEffects(StrikeInterface $strike);
}