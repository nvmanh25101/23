<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TeacherStatusEnum extends Enum
{
    public const DI_DAY =   0;
    public const NGHI_DAY =   1;

    public static function getArrayView(): array
    {
        return [
            'Đi dạy' => self::DI_DAY,
            'Nghỉ dạy' => self::NGHI_DAY,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
