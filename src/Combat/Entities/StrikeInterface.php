<?php
namespace Combat\Entities;

use Unit\Entities\UnitInterface;

interface StrikeInterface
{
    /**
     * @return UnitInterface
     */
    public function getAttacker();
    /**
     * @return UnitInterface
     */
    public function getDefender();
    public function resolveStrike();

    /**
     * @return int
     */
    public function getAddedFlatStrength();

    /**
     * @param int $addedFlatStrength
     * @return StrikeInterface
     */
    public function setAddedFlatStrength($addedFlatStrength);

    /**
     * @return int
     */
    public function getStrengthMultiplier();

    /**
     * @param int $strengthMultiplier
     * @return StrikeInterface
     */
    public function setStrengthMultiplier($strengthMultiplier);

    /**
     * @return int
     */
    public function getAddedFlatDefense();

    /**
     * @param int $addedFlatDefense
     * @return StrikeInterface
     */
    public function setAddedFlatDefense($addedFlatDefense);

    /**
     * @return int
     */
    public function getDefenseMultiplier();

    /**
     * @param int $defenseMultiplier
     * @return StrikeInterface
     */
    public function setDefenseMultiplier($defenseMultiplier);

    /**
     * @param int $percentageDamageReduction
     * @return StrikeInterface
     */
    public function setPercentageDamageReduction($percentageDamageReduction);

    /**
     * @return int
     */
    public function getPercentageDamageReduction();

    /**
     * @param $flatDamageReduction
     * @return StrikeInterface
     */
    public function setFlatDamageReduction($flatDamageReduction);

    /**
     * @return int
     */
    public function getFlatDamageReduction();

}