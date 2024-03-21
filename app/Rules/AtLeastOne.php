<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AtLeastOne implements ValidationRule
{
    private $Edit;

    public function __construct($edit = false)
    {
        $this->Edit = $edit;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ok = false;

        if($value != null && is_array($value)) {
            foreach ($value as $item) {
                if(is_array($item) && (array_key_exists('dato', $item) || array_key_exists('path', $item))) {
                    if(array_key_exists('dato', $item) && is_array($item['dato']) && count($item['dato']) > 0) {
                        $ok = true;
                    } else if(array_key_exists('path', $item) && $item['path'] !== '') {
                        $ok = true;
                    }
                }
            }
        }

        if ($ok === false) {
            $fail(__('validation.at_least_one', ['attribute' => $attribute]));
        }
    }
}
