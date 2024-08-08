<?php

namespace App\Services;

class BoolConverter
{
    public static function StatusConverter(int $status)
    {
        if ($status == 1) {
            return 'Completed';
        }
        else {
            return 'Incomplete';
        }
    }
}
