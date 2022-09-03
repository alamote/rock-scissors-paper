<?php

namespace App\Game;

use App\Player\Player;

class Game
{
    protected int   $rounds;
    protected array $players = [];

    public function __construct(int $rounds = 10, string $firstPlayer = 'Player-1', string $secondPlayer = 'Player-2')
    {
        $this->players[] = new Player($firstPlayer, $rounds);
        $this->players[] = new Player($secondPlayer, $rounds);
        $this->rounds    = $rounds;
    }

    protected function firstPlayer(): Player
    {
        return $this->players[0];
    }

    protected function secondPlayer(): Player
    {
        return $this->players[1];
    }

    public function getRounds(): int
    {
        return $this->rounds;
    }

    protected function getWinner(int $round): ?Player
    {
        $result = $this->firstPlayer()->getCase($round)->compare($this->secondPlayer()->getCase($round));
        if (is_null($result)) {
            return null;
        }
        if ($result) {
            return $this->firstPlayer();
        }

        return $this->secondPlayer();
    }

    protected function getGameWinner(): ?Player
    {
        $difference = $this->firstPlayer()->getPoints() - $this->secondPlayer()->getPoints();
        if (!$difference) {
            return null;
        } elseif ($difference > 0) {
            return $this->firstPlayer();
        }

        return $this->secondPlayer();
    }

    public function run(): void
    {
        for ($i = 0; $i < $this->rounds; $i++) {
            $winner = $this->getWinner($i);
            $result = [
                sprintf('%3d.', $i + 1),
                sprintf('[%s]', $this->firstPlayer()->getName()),
                $this->firstPlayer()->getCase($i)::$name,
                'vs',
                sprintf('[%s]', $this->secondPlayer()->getName()),
                $this->secondPlayer()->getCase($i)::$name,
                '-'
            ];
            if ($winner) {
                $winner->addPoint();
                $result[] = $winner->getName();
            } else {
                $result[] = 'No winner';
            }
            echo implode(' ', $result) . PHP_EOL;
        }
        $winner = $this->getGameWinner();
        if ($winner) {
            echo sprintf("%s wins (%s %d:%d %s).%s", $winner->getName(), $this->firstPlayer()->getName(), $this->firstPlayer()->getPoints(), $this->secondPlayer()->getPoints(), $this->secondPlayer()->getName(), PHP_EOL);
        } else {
            echo 'No winner.' . PHP_EOL;
        }
    }
}
