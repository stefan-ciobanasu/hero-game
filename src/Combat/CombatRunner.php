<?php

namespace Combat;

use Combat\Models\Logger;
use Unit\Builders\HeroBuilder;
use Unit\Builders\MonsterBuilder;
use Unit\Entities\UnitInterface;
use Unit\Models\Hero;
use Unit\Models\Monster;

class CombatRunner
{
    /** @var UnitInterface */
    protected $attacker;
    /** @var UnitInterface */
    protected $defender;
    /** @var UnitInterface|null */
    protected $winner = null;

    public function runSimulation()
    {
        $hero = HeroBuilder::build();
        $monster = MonsterBuilder::build();
        $this->logActorGeneration($hero, $monster);
        $this->settleStartingPositions($hero, $monster);
        $roundCounter = 0;
        $logger = new Logger();
        while ($roundCounter<20) {
            $strike = StrikeBuilder::createNewStrike($this->getAttacker(), $this->getDefender(), $logger);
            $strike->resolveStrike();
            if ($this->getDefender()->getHealth() <= 0) {
                $this->declareWinner($this->getAttacker());
                break;
            }
            $this->swapPositions($this->getAttacker(), $this->getDefender());
            $roundCounter++;
        }
        echo $logger->getCombatLog();
        $this->logEndCombat();
        return true;
    }

    /**
     * @param Hero $hero
     * @param Monster $monster
     */
    protected function logActorGeneration($hero, $monster)
    {
        echo "Running new combat simulation ...<br/><br/>";
        echo "Hero was generated with the following stats:<br/>";
        echo "● Health: " . $hero->getHealth() . "<br/>";
        echo "● Strength: " . $hero->getStrength() . "<br/>";
        echo "● Defence: " . $hero->getDefence() . "<br/>";
        echo "● Speed: " . $hero->getSpeed() . "<br/>";
        echo "● Luck: " . $hero->getLuck() . "%<br/><br/>";
        echo "Wild beast was generated with the following stats:<br/>";
        echo "● Health: " . $monster->getHealth() . "<br/>";
        echo "● Strength: " . $monster->getStrength() . "<br/>";
        echo "● Defence: " . $monster->getDefence() . "<br/>";
        echo "● Speed: " . $monster->getSpeed() . "<br/>";
        echo "● Luck: " . $monster->getLuck() . "%<br/><br/>";
    }

    /**
     * @param UnitInterface $combatant1
     * @param UnitInterface $combatant2
     */
    protected function settleStartingPositions($combatant1, $combatant2)
    {
        $sortingPot = [$combatant1, $combatant2];
        usort($sortingPot, [$this, 'compareCombatants']);
        $this->setAttacker($sortingPot[0]);
        $this->setDefender($sortingPot[1]);
    }

    /**
     * @param $a
     * @param $b
     * @return mixed
     */
    protected function compareCombatants($a, $b) {
        $result = $b->getSpeed() - $a->getSpeed();
        if ($result === 0) {
            $result = $b->getLuck() - $a->getLuck();
        }
        return $result;
    }

    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    protected function swapPositions($attacker, $defender) {
        $this->setAttacker($defender);
        $this->setDefender($attacker);
    }

    protected function logEndCombat() {
        if ($this->getWinner() !== null) {
            if (method_exists($this->getWinner(),'getName')) {
                $winnerName = $this->getWinner()->getName();
            } else {
                $winnerName = "The Wild Beast";
            }
            echo $winnerName . " won the battle, by reducing their enemy to a heap of meat and bones.<br/>";
        } else {
            echo "After a savage battle, with both combatants bloodied and bruised, a winner could not be determined.<br/>";
        }
    }

    /**
     * @param UnitInterface $winner
     */
    protected function declareWinner($winner) {
        $this->winner = $winner;
    }

    /**
     * @return UnitInterface
     */
    protected function getWinner()
    {
        return $this->winner;
    }

    /**
     * @return UnitInterface
     */
    protected function getAttacker()
    {
        return $this->attacker;
    }

    /**
     * @param UnitInterface $attacker
     * @return CombatRunner
     */
    protected function setAttacker($attacker)
    {
        $this->attacker = $attacker;
        return $this;
    }

    /**
     * @return UnitInterface
     */
    protected function getDefender()
    {
        return $this->defender;
    }

    /**
     * @param UnitInterface $defender
     * @return CombatRunner
     */
    protected function setDefender($defender)
    {
        $this->defender = $defender;
        return $this;
    }
}