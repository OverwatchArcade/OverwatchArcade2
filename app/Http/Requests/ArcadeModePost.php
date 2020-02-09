<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArcadeModePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()){
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
            'tile_1.id' => 'required|exists:gamemodes,id',
            'tile_2.id' => 'required|exists:gamemodes,id',
            'tile_3.id' => 'required|exists:gamemodes,id',
            'tile_4.id' => 'required|exists:gamemodes,id',
            'tile_5.id' => 'required|exists:gamemodes,id',
            'tile_6.id' => 'required|exists:gamemodes,id',
            'tile_7.id' => 'required|exists:gamemodes,id',
        ];
    }
}
