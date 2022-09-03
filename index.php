<?php

include_once 'vendor/autoload.php';

use App\Game\Game;

$game = new Game($argv[1] ?? 10, $argv[2] ?? 'Player-1', $argv[3] ?? 'Player-2');
$game->run();
