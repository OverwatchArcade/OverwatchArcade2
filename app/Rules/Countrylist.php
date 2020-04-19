<?php

namespace App\Rules;

use App\Models\Config;
use Illuminate\Contracts\Validation\Rule;

class Countrylist implements Rule
{
    public $countries;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->countries = Config::where('key', Config::KEY_COUNTRIES)->firstOrFail()->value;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return boolval(array_search($value, array_column($this->countries, 'code')));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid country';
    }
}
