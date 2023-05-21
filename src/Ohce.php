<?php

namespace UserLoginService;
class Ohce
{
    public string $name;
    public DateProvider $dateProvider;
    public function __construct(DateProvider $dateProvider)
    {
        $this->dateProvider = $dateProvider;
    }


    public function responder(string $input): string
    {
        $words = explode(" ", $input);
        if ($words[0] == "ohce") {
            $time = $this->dateProvider->getTime();
            $this->name = $words[1];
            if ($time >= '06:00:00' && $time <= '12:00:00') {
                return "¡Buenos días " . $this->name . "!";
            } elseif ($time >= '12:00:00' && $time <= '20:00:00') {
                return "¡Buenas tardes " . $this->name . "!";
            }
            return "¡Buenas noches " . $this->name . "!";
        }

        if (strcmp(strrev($input), $input) === 0) {
            return implode(" ", [strrev($input),"¡Bonita palabra!"]);
        }

        return strrev($input);
    }
    public function whatTimeIsIt(): string
    {
        return rand(0, 24);
    }
}
