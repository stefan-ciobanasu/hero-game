<?php

namespace Unit\Builders;

use Skills\Entities\SkillCollection;
use Unit\Models\Monster;

class MonsterBuilder
{
    public static function build()
    {
        return new Monster(
            mt_rand(60,90),
            mt_rand(60,90),
            mt_rand(40,60),
            mt_rand(40,60),
            mt_rand(25,40),
            new SkillCollection()
        );
    }
}