<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TeacherLevelEnum extends Enum
{
    public const TRUONG_KHOA = 0;
    public const GIANG_VIEN = 1;

    public static function getArrayView(): array
    {
        return [
            'Giảng viên' => self::GIANG_VIEN,
            'Trưởng khoa' => self::TRUONG_KHOA,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
