<?php

namespace Combat;

use Combat\Models\Logger;
use Unit\Entities\UnitInterface;

class CombatRunner
{
    /** @var UnitInterface */
    protected $attacker;
    /** @var UnitInterface */
    protected $defender;
    /** @var UnitInterface|null */
    protected $winner = null;

    /**
     * @param UnitInterface $combatant1
     * @param UnitInterface $combatant2
     * @return bool
     */
    public function runSimulation(UnitInterface $combatant1, UnitInterface $combatant2)
    {
        $this->logActorGeneration($combatant1, $combatant2);
        $this->settleStartingPositions($combatant1, $combatant2);
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
     * @param UnitInterface $combatant1
     * @param UnitInterface $combatant2
     */
    protected function logActorGeneration(UnitInterface $combatant1, UnitInterface $combatant2)
    {
        if (method_exists($combatant1, 'getName')) {
            $cName1 = $combatant1->getName();
        } else {
            $cName1 = "Wild Beast";
        }

        if (method_exists($combatant2, 'getName')) {
            $cName2 = $combatant2->getName();
        } else {
            $cName2 = "Wild Beast";
        }

        echo "Running new combat simulation ...<br/><br/>";
        echo $cName1 . " was generated with the following stats:<br/>";
        echo "● Health: " . $combatant1->getHealth() . "<br/>";
        echo "● Strength: " . $combatant1->getStrength() . "<br/>";
        echo "● Defence: " . $combatant1->getDefence() . "<br/>";
        echo "● Speed: " . $combatant1->getSpeed() . "<br/>";
        echo "● Luck: " . $combatant1->getLuck() . "%<br/><br/>";
        echo $cName2 . " was generated with the following stats:<br/>";
        echo "● Health: " . $combatant2->getHealth() . "<br/>";
        echo "● Strength: " . $combatant2->getStrength() . "<br/>";
        echo "● Defence: " . $combatant2->getDefence() . "<br/>";
        echo "● Speed: " . $combatant2->getSpeed() . "<br/>";
        echo "● Luck: " . $combatant2->getLuck() . "%<br/><br/>";
    }

    /**
     * @param UnitInterface $combatant1
     * @param UnitInterface $combatant2
     */
    protected function settleStartingPositions(UnitInterface $combatant1, UnitInterface $combatant2)
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
    public function compareCombatants($a, $b) {
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
    protected function swapPositions(UnitInterface $attacker, UnitInterface $defender) {
        $this->setAttacker($defender);
        $this->setDefender($attacker);
    }

    /**
     * Just a separation of code from the main method
     */
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
    protected function declareWinner(UnitInterface $winner) {
        $this->winner = $winner;
    }

    /**
     * @return UnitInterface
     */
    public function getWinner()
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
    protected function setAttacker(UnitInterface $attacker)
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
    protected function setDefender(UnitInterface $defender)
    {
        $this->defender = $defender;
        return $this;
    }
}