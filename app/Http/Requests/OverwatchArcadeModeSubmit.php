<?php

namespace App\Http\Requests;

use App\Rules\ValidOverwatchGamemode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OverwatchArcadeModeSubmit extends FormRequest
{
    /**        return $this->arcadeModes->has($value);

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
            'tile_1.id' => ['required', new ValidOverwatchGamemode()],
            'tile_2.id' => ['required', new ValidOverwatchGamemode()],
            'tile_3.id' => ['required', new ValidOverwatchGamemode()],
            'tile_4.id' => ['required', new ValidOverwatchGamemode()],
            'tile_5.id' => ['required', new ValidOverwatchGamemode()],
            'tile_6.id' => ['required', new ValidOverwatchGamemode()],
            'tile_7.id' => ['required', new ValidOverwatchGamemode()]
        ];
    }
}
