<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CourseDetailType extends Enum
{
    public const LICH_HOC =   0;
    public const LICH_THI =   1;
}
