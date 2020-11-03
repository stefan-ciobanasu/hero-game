<?php
namespace Unit\Combat;

use Combat\Models\Logger;
use Combat\StrikeBuilder;
use PHPUnit\Framework\TestCase;
use Skills\Entities\SkillCollection;
use Spells\Models\MagicShield;
use Spells\Models\RapidStrike;
use Unit\Models\Hero;
use Unit\Models\Monster;

class StrikeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testResolveStrike(): void
    {
        $skills = new SkillCollection();
        $attacker = new Hero(
            100,
            80,
            70,
            40,
            35,
            $skills
        );
        $attacker->setSkills($skills);
        $defender = new Monster(
            100,
            70,
            60,
            30,
            20,
            $skills
        );
        $defender->setSkills($skills);
        $logger = new Logger();
        $strike = StrikeBuilder::createNewStrike($attacker,$defender,$logger)->resolveStrike();

        $this->assertEquals(20, $strike->getDamageDone());
        $this->assertEquals(80, $strike->getDefender()->getHealth());
    }

    public function testSetters(): void
    {
        $skills = new SkillCollection();
        $attacker = new Hero(
            100,
            80,
            70,
            40,
            35,
            $skills
        );
        $defender = new Monster(
            100,
            70,
            60,
            30,
            20,
            $skills
        );
        $logger = new Logger();
        $strike = StrikeBuilder::createNewStrike($attacker,$defender,$logger)->resolveStrike();
        $skillCollection = new SkillCollection();
        $skillCollection->addSkill(new RapidStrike());
        $skillCollection->addSkill(new MagicShield());
        $strike->setSkillCollection($skillCollection);
        $strike->setAddedFlatDefense(10);
        $strike->setAddedFlatStrength(10);
        $strike->setStrengthMultiplier(1.1);
        $strike->setDefenseMultiplier(1.1);
        $strike->setFlatDamageReduction(10);
        $strike->setPercentageDamageReduction(0.2);

        $this->assertEquals($skillCollection, $strike->getSkillCollection());
        $this->assertEquals(10, $strike->getAddedFlatDefense());
        $this->assertEquals(10, $strike->getAddedFlatStrength());
        $this->assertEquals(1.1, $strike->getStrengthMultiplier());
        $this->assertEquals(1.1, $strike->getDefenseMultiplier());
        $this->assertEquals(10, $strike->getFlatDamageReduction());
        $this->assertEquals(0.2, $strike->getPercentageDamageReduction());
    }
}