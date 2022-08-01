<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class NationalCode implements InvokableRule
{
    const NATIONAL_CODE_LENGTH = 10;

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $sum = 0;

        $digits = str_split($value);

        for ($i = self::NATIONAL_CODE_LENGTH; $i > 1; $i--) {
            $sum += $digits[self::NATIONAL_CODE_LENGTH - $i] * $i;
        }

        $remind = $sum % 11;

        if ($this->validate($remind, $value[self::NATIONAL_CODE_LENGTH - 1])) {
            $fail('The national code is not valid.');
        }
    }

    private function validate(int $remind, int $controller)
    {
        return ($remind >= 2 and 11 - $remind != $controller) or ($remind < 2 and $remind != $controller);
    }
}
