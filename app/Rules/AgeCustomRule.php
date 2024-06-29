<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Config;
use Illuminate\Translation\PotentiallyTranslatedString;

class AgeCustomRule implements ValidationRule
{
    private array $parameters;

    public function __construct()
    {
        $this->parameters = Config::get('parameters');
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ages = explode(",", $value);
        $ageLoad = $this->parameters['age_load'];
        $minAge = array_key_first($ageLoad);
        $maxAge = array_key_last($ageLoad);

         if($this->hasInvalidAge($ages, $minAge, $maxAge)){
             $fail("The :attribute has invalid age. Age has to be between {$minAge} and {$maxAge}");
         }
    }

    private function hasInvalidAge(array $ages, int $minAge, int $maxAge): bool
    {
        return collect($ages)->filter(function ($age) use ($minAge, $maxAge) {
            return $minAge > $age || $maxAge < $age;
        })->containsOneItem();
    }
}
