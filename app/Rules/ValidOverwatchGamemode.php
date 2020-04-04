<?php

namespace App\Rules;

use App\Models\Config;
use App\Models\Game\Daily;
use App\Models\Game\Gamemode;
use Illuminate\Contracts\Validation\Rule;

class ValidOverwatchGamemode implements Rule
{
    public $arcadeModes;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->arcadeModes = Gamemode::where('game', Daily::GAME_KEY_OVERWATCH)->get();
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
        return $this->arcadeModes->has($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No Arcade mode found.';
    }
}
