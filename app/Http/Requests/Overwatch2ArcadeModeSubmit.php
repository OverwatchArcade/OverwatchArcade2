<?php

namespace App\Http\Requests;

use App\Rules\ValidOverwatch2Gamemode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Overwatch2ArcadeModeSubmit extends FormRequest
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
        return [
            'tile_1.id' => ['required', new ValidOverwatch2Gamemode()],
            'tile_2.id' => ['required', new ValidOverwatch2Gamemode()],
            'tile_3.id' => ['required', new ValidOverwatch2Gamemode()],
            'tile_4.id' => ['required', new ValidOverwatch2Gamemode()],
            'tile_5.id' => ['required', new ValidOverwatch2Gamemode()],
            'tile_6.id' => ['required', new ValidOverwatch2Gamemode()],
            'tile_7.id' => ['required', new ValidOverwatch2Gamemode()]
        ];
    }
}
