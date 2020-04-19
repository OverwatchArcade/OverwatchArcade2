<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    const UNDO_SUBMIT_OW = "UNDO_SUBMIT_OW";
    const UNDO_SUBMIT_OW2 = "UNDO_SUBMIT_OW2";

    protected $guarded = [];
    protected $casts = [
        'payload' => 'array',
    ];
}
