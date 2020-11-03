<?php
namespace Unit\Combat;

use Combat\CombatRunner;
use PHPUnit\Framework\TestCase;
use Skills\Entities\SkillCollection;
use Unit\Models\Hero;
use Unit\Models\Monster;

class CombatRunnerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCompareCombatants(): void
    {
        $c1 = new Hero(100, 100, 100, 40, 35, new SkillCollection());
        $c2 = new Monster(100, 100, 100, 40, 40, new SkillCollection());
        $runner = new CombatRunner();

        $expected = 5;
        $actual = $runner->compareCombatants($c1, $c2);

        $this->assertEquals($expected, $actual);
    }

    public function testSimulationFlawlessWin(): void
    {
        $c1 = new Hero(100, 100, 80, 40, 35, new SkillCollection());
        $c2 = new Monster(100, 80, 50, 40, 40, new SkillCollection());

        $runner = new CombatRunner();
        $runner->runSimulation($c1, $c2);

        $expectedWinner = $c1;
        $actualWinner = $runner->getWinner();

        $this->assertEquals($expectedWinner, $actualWinner);
    }

    public function testSimulationNormalWin(): void
    {
        $c1 = new Hero(100, 100, 70, 40, 35, new SkillCollection());
        $c2 = new Monster(100, 80, 50, 40, 40, new SkillCollection());

        $runner = new CombatRunner();
        $runner->runSimulation($c1, $c2);

        $expectedWinner = new Hero(80, 100, 70, 40, 35, new SkillCollection());
        $actualWinner = $runner->getWinner();

        $this->assertEquals($expectedWinner, $actualWinner);
    }

    public function testSimulationNeverWin(): void
    {
        $c1 = new Hero(100, 80, 80, 40, 35, new SkillCollection());
        $c2 = new Monster(100, 80, 80, 40, 40, new SkillCollection());

        $runner = new CombatRunner();
        $runner->runSimulation($c1, $c2);

        $expectedWinner = null;
        $actualWinner = $runner->getWinner();

        $this->assertEquals($expectedWinner, $actualWinner);
    }
}