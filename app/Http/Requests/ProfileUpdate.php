<?php

namespace App\Http\Requests;

use App\Models\Config;
use App\Models\Game\Daily;
use App\Models\Game\Gamemode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $mapConfig = Config::where('key', Config::KEY_OVERWATCH_MAPS)->firstOrFail();
        $characterConfig = Config::where('key', Config::KEY_OVERWATCH_CHARACTERS)->firstOrFail();
        $countries = Config::where('key', Config::KEY_COUNTRIES)->firstOrFail();

        return [
            'avatar' => 'nullable|image|dimensions:ratio=1/1,max_width:200|size:100',
            'game.map.*' => ['nullable', Rule::in($mapConfig->value)],
            'game.mode.*' => 'nullable|exists:gamemodes,name',
            'game.character.*' => ['nullable', Rule::in($characterConfig->value)],
            'profile.country' => ['nullable'],
            'profile.about' => 'nullable|max:500'
        ];
    }
}