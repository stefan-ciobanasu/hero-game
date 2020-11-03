<?php
namespace Skills\Entities;

trait SkillTraits
{
    /**
     * @param int $chance
     * @return bool
     */
    protected function skillActivates(int $chance)
    {
        return (mt_rand(0,100) < $chance);
    }
}