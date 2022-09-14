<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StudentStatusEnum extends Enum
{
    public const NGHI_LUON = 0;
    public const BAO_LUU = 1;
    public const DANG_HOC = 2;

    public static function getArrayView(): array
    {
        return [
            'Nghỉ luôn' => self::NGHI_LUON,
            'Bảo lưu' => self::BAO_LUU,
            'Đang học' => self::DANG_HOC,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
