<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TeacherLevelEnum extends Enum
{
    public const PHONG_DAO_TAO = 0;
    public const GIANG_VIEN = 1;

    public static function getArrayView(): array
    {
        return [
            'Giảng viên' => self::GIANG_VIEN,
            'Phòng đào tạo' => self::PHONG_DAO_TAO,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
