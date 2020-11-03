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

    /**
     * @return StrikeInterface
     */
    public function resolveStrike();

    /**
     * @return int
     */
    public function getAddedFlatStrength();

    /**
     * @param int $addedFlatStrength
     * @return StrikeInterface
     */
    public function setAddedFlatStrength(int $addedFlatStrength);

    /**
     * @return float
     */
    public function getStrengthMultiplier();

    /**
     * @param float $strengthMultiplier
     * @return StrikeInterface
     */
    public function setStrengthMultiplier(float $strengthMultiplier);

    /**
     * @return int
     */
    public function getAddedFlatDefense();

    /**
     * @param int $addedFlatDefense
     * @return StrikeInterface
     */
    public function setAddedFlatDefense(int $addedFlatDefense);

    /**
     * @return float
     */
    public function getDefenseMultiplier();

    /**
     * @param float $defenseMultiplier
     * @return StrikeInterface
     */
    public function setDefenseMultiplier(float $defenseMultiplier);

    /**
     * @param float $percentageDamageReduction
     * @return StrikeInterface
     */
    public function setPercentageDamageReduction(float $percentageDamageReduction);

    /**
     * @return float
     */
    public function getPercentageDamageReduction();

    /**
     * @param int $flatDamageReduction
     * @return StrikeInterface
     */
    public function setFlatDamageReduction(int $flatDamageReduction);

    /**
     * @return int
     */
    public function getFlatDamageReduction();

}