<?php

namespace App\Helpers;


class Constant
{
    const ADMIN = 'admin';
    const AGENT = 'agent';
    const SUB_AGENT = 'sub_agent';

    const ADMISSION_STATUS_DECLINE = 0;
    const ADMISSION_STATUS_PENDING = 1;
    const ADMISSION_STATUS_CONDITIONAL_LOA = 2;
    const ADMISSION_STATUS_PENDING_FINAL_LOA = 3;
    const ADMISSION_STATUS_FINAL_LOA = 4;

    const SIGNED_LOA_FOLDER = 'signed_loa';
    const SIGNATURE_FOLDER = 'signature';
}

class AppHelpers
{
    public static function num_format($number, $decimals = 2, $dec_point = '.', $thousands_sep = ',')
    {
        return number_format($number, $decimals, $dec_point, $thousands_sep);
    }
}
