<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TeacherTypeEnum extends Enum
{
    public const SINH_VIEN =   0;
    public const GIAO_VIEN =   1;
}
