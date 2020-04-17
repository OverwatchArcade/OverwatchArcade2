<?php

namespace App\Models;

use App\Models\Game\Daily;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'battlenet_id',
        'avatar',
        'profile_data'
    ];

    protected $casts = [
        'profile_data' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAvatarAttribute($value)
    {
        if ($value != null && Storage::disk('public')->exists("img/avatars/" . $value)) {
            return secure_asset("img/avatars/" . $value);
        }
        return secure_asset('img/avatars/default.jpg');
    }

    public function getContributedDailies()
    {
        return $this->hasMany(Daily::class, 'user_battlenet_id', 'battlenet_id');
    }

    /**
     * @return |null
     */
    public function getLastContributed()
    {
        $dailys = $this->getContributedDailies();
        if (!$dailys->count()) {
            return null;
        }
        return Carbon::parse($dailys->latest()->first()->created_at)->diffForHumans();
    }

}
