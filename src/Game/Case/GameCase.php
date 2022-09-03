<?php

namespace App\Game\Case;

class GameCase
{
    public static string $name;

    public function compare(GameCase $case): ?bool
    {
        $rules = [
            PaperCase::$name    => RockCase::$name,
            RockCase::$name     => ScissorsCase::$name,
            ScissorsCase::$name => PaperCase::$name,
        ];

        if (static::$name === $case::$name) {
            return null;
        }
        if (empty($rules[static::$name])) {
            return false;
        }
        return $rules[static::$name] === $case::$name;
    }

}
