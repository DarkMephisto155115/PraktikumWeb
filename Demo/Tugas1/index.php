<?php

namespace Game\StarRailCharacters;

trait ArchetypeTrait
{
    public function getArchetypeTrait()
    {
        if ($this->archetype == null) {
            echo $this->name . " tidak memiliki Archetype" . "!\n";
        } else {
            echo $this->name . " memiliki Archetype : " . $this->archetype . "!\n";
        }

    }
}


abstract class StarRailCharacters
{
    protected $name;
    protected $element;

    protected $rarity;
    protected $talent;
    protected $technique;
    protected $basic_attack;
    protected $skill;
    protected $ultimate;

    public function __construct($name, $element, $rarity, $talent, $technique, $basic_attack, $skill, $ultimate)
    {
        $this->name = $name;
        $this->element = $element;
        $this->rarity = $rarity;
        $this->talent = $talent;
        $this->technique = $technique;
        $this->basic_attack = $basic_attack;
        $this->skill = $skill;
        $this->ultimate = $ultimate;
    }

    abstract public function getPath();
    abstract public function getPathDescription();

    public function __toString()
    {
        return $this->name . " [Rarity: " . $this->rarity . ", Element: " . $this->element . ", Path: " . $this->getPath() . "]";
    }

}

class Destruction extends StarRailCharacters
{
    use ArchetypeTrait;
    private $archetype;
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }
    protected $path = "Destruction";
    public function getPath()
    {
        return $this->path;
    }
    public function getPathDescription()
    {
        return "Those who follow the \"Destruction\" Path admire recklessness, anger, and destructive behavior.";
    }
}

class Hunt extends StarRailCharacters
{
    use ArchetypeTrait;
    private $archetype;
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }
    protected $path = "Hunt";
    public function getPath()
    {
        return $this->path;
    }
    public function getPathDescription()
    {
        return "Those who follow the \"Hunt\" Path admire determination, ruthlessness, and tenacious behavior.";
    }
}

class Erudition extends StarRailCharacters
{
    use ArchetypeTrait;
    private $archetype;
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }
    protected $path = "Erudition";
    public function getPath()
    {
        return $this->path;
    }
    public function getPathDescription()
    {
        return "Those who follow the \"Erudition\" Path admire thinking, logic, and strategic behavior.";
    }
}



class Harmony extends StarRailCharacters
{
    use ArchetypeTrait;
    private $archetype;
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }
    protected $path = "Harmony";
    public function getPath()
    {
        return $this->path;
    }
    public function getPathDescription()
    {
        return "Those who follow the \"Harmony\" Path admire understanding, support, and cooperative behavior.";
    }
}

class Nihility extends StarRailCharacters
{
    use ArchetypeTrait;
    private $archetype;
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }
    protected $path = "Nihility";
    public function getPath()
    {
        return $this->path;
    }
    public function getPathDescription()
    {
        return "Those who follow the \"Nihility\" Path admire laziness, exhaustion, and meaningless behavior.";
    }
}

class Preservation extends StarRailCharacters
{
    use ArchetypeTrait;
    private $archetype;
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }
    protected $path = "Preservation";
    public function getPath()
    {
        return $this->path;
    }
    public function getPathDescription()
    {
        return "Those who follow the \"Preservation\" Path admire patience, sacrifice, and defensive behavior.";
    }
}

class Abundance extends StarRailCharacters
{
    use ArchetypeTrait;
    private $archetype;
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }
    protected $path = "Abundance";
    public function getPath()
    {
        return $this->path;
    }
    public function getPathDescription()
    {
        return "Those who follow the \"Abundance\" Path admire selflessness, altruism, and healing behavior.";
    }
}

$Fexiao = new Hunt("Fexiao", "Wind", "5 Star", "Thunderhunt", "Stormborn", "Boltsunder", "Waraxe", "Terrasplit");

$Fexiao->setArchetype("Follow Up Attack");



echo $Fexiao . "\n";

$Fexiao->getArchetypeTrait();
echo $Fexiao->getPathDescription();