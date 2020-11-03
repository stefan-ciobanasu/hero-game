<?php
namespace Unit\Combat;

use Combat\Models\Logger;
use PHPUnit\Framework\TestCase;
use Unit\Builders\HeroBuilder;
use Unit\Builders\MonsterBuilder;

class LoggerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testPushMessage() : void
    {
        $attacker = HeroBuilder::build();
        $defender = MonsterBuilder::build();
        $message = "{attacker} bites {defender}'s nose.";
        $logger = new Logger();
        $logger->pushToCombatLog($message, $attacker, $defender);

        $expected = "Orderus bites Wild Beast's nose.";
        $actual = $logger->getCombatLog();

        $this->assertEquals($expected, $actual);
    }
}