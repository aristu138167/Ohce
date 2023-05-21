<?php

namespace UserLoginService;

class DateProvider
{
    public function getTime(): string
    {
        return date("H:i:s");
    }
}