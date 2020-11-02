<?php
namespace Skills\Entities;

class SkillCollection
{
    /**
     * @var array|Skill
     */
    private $skillCollection=[];

    public function __construct($skillCollection=[])
    {
        $this->skillCollection = $skillCollection;
    }

    /**
     * @param Skill $skill
     * @return SkillCollection
     */
    public function addSkill(Skill $skill)
    {
        $this->skillCollection[$this->slugify($skill->getName())] = $skill;
        return $this;
    }

    /**
     * @return array|Skill
     */
    public function getCollection()
    {
        return $this->skillCollection;
    }

    /**
     * @param $name
     * @return Skill|null
     */
    public function getSkillByName($name)
    {
        $index = $this->slugify($name);
        if (array_key_exists($index, $this->skillCollection)) {
            return $this->skillCollection[$index];
        }
        return null;
    }

    /**
     * @param $name
     * @return SkillCollection
     */
    public function removeSkillByName($name)
    {
        $index = $this->slugify($name);
        if (array_key_exists($index, $this->skillCollection)) {
            unset($this->skillCollection[$index]);
        }
        return $this;
    }

    /**
     * @param string $type
     * @return array|Skill
     */
    public function getSkillsByType($type)
    {
        $returnCollection = [];
        foreach ($this->skillCollection as $skill)
        {
            if ($skill->getType() == $type) {
                $returnCollection[] = $skill;
            }
        }
        return $returnCollection;
    }

    /**
     * @param string $timing
     * @return array|Skill
     */
    public function getSkillsByTiming($timing)
    {
        $returnCollection = [];
        foreach ($this->skillCollection as $skill)
        {
            if ($skill->getTiming() == $timing) {
                $returnCollection[] = $skill;
            }
        }
        return $returnCollection;
    }

    /**
     * @param $inputString
     * @return string
     */
    private function slugify($inputString)
    {
        $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $inputString);
        $string = preg_replace('/[-\s]+/', '-', $string);
        return trim($string, '-');
    }
}