<?php

namespace Unit\Builders;

use Skills\Entities\SkillCollection;
use Spells\Models\MagicShield;
use Spells\Models\RapidStrike;
use Unit\Models\Hero;

class HeroBuilder
{
    /**
     * @return Hero
     */
    public static function build()
    {
        $skills = new SkillCollection();
        $skills->addSkill(new RapidStrike());
        $skills->addSkill(new MagicShield());
        return new Hero(
            mt_rand(70,100),
            mt_rand(70,80),
            mt_rand(45,55),
            mt_rand(40,50),
            mt_rand(10,30),
            $skills
        );
    }
}