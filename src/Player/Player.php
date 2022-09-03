<?php

namespace App\Player;

use App\Game\Case\GameCase;
use App\Game\Case\PaperCase;
use App\Game\Case\RockCase;
use App\Game\Case\ScissorsCase;

class Player
{
    protected string $name;
    protected array  $cases  = [];
    protected int    $rounds;
    protected int    $points = 0;

    public function __construct(string $name, int $rounds = 10)
    {
        $this->rounds = $rounds;
        $this->setName($name);
        $this->seedCases();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addPoint(): void
    {
        $this->points++;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function getCase(int $round): GameCase
    {
        return $this->cases[$round];
    }

    protected function seedCases(): void
    {
        $cases = [PaperCase::$name, RockCase::$name, ScissorsCase::$name];
        for ($i = 0; $i < $this->rounds; $i++) {
            $caseClass     = 'App\\Game\\Case\\' . $cases[rand(0, 2)] . 'Case';
            $this->cases[] = new $caseClass();
        }
    }
}
