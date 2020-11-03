<?php
namespace Unit\Skills;

use PHPUnit\Framework\TestCase;
use Skills\Entities\SkillCollection;
use Skills\Entities\SkillTiming;
use Skills\Entities\SkillType;
use Spells\Models\MagicShield;
use Spells\Models\RapidStrike;

class SkillCollectionTest extends TestCase
{
    public $skillCollection = null;

    protected function setUp(): void
    {
        parent::setUp();
        $skills = [
            new MagicShield(),
            new RapidStrike()
        ];
        $this->skillCollection = new SkillCollection($skills);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->skillCollection = null;
    }

    public function testGetCollection(): void
    {
        $expected = [
            'magic-shield' => new MagicShield(),
            'rapid-strike' => new RapidStrike()
        ];
        $actual = $this->skillCollection->getCollection();

        $this->assertEquals($expected, $actual);
    }

    public function testGetSkillByName(): void
    {
        $expected = new MagicShield();
        $actual = $this->skillCollection->getSkillByName('Magic Shield');

        $this->assertEquals($expected, $actual);
    }

    public function testGetSkillByNameFail(): void
    {
        $expected = null;
        $actual = $this->skillCollection->getSkillByName('Magic Sword');

        $this->assertEquals($expected, $actual);
    }

    public function testRemoveSkillByName(): void
    {
        $expected = [
            'rapid-strike' => new RapidStrike()
        ];
        $actual = $this->skillCollection->removeSkillByName('Magic Shield')->getCollection();

        $this->assertEquals($expected, $actual);
    }

    public function testGetSkillsByType(): void
    {
        $expected = [
            new RapidStrike()
        ];
        $actual = $this->skillCollection->getSkillsByType(SkillType::OFFENSIVE);

        $this->assertEquals($expected, $actual);
    }

    public function testGetSkillsByTiming(): void
    {
        $expected = [
            new MagicShield()
        ];
        $actual = $this->skillCollection->getSkillsByTiming(SkillTiming::PRE_STRIKE);

        $this->assertEquals($expected, $actual);
    }

}