<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Constants\UserConstant;
use App\Traits\ObserverTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, ObserverTrait;
    // SoftDeletes not use this
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'name',
        'division_id',
        'entered_date',
        'position_id',
        'created_date',
        'updated_date',
        'deleted_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function scopePosition($query, $positionId)
    {
        $positionName = '';
        if ($positionId == UserConstant::MEMBER[0]) {
            $positionName = UserConstant::MEMBER[1];
        } elseif ($positionId == UserConstant::LEADER[0]) {
            $positionName = UserConstant::LEADER[1];
        } elseif ($positionId == UserConstant::GROUP_LEADER[0]) {
            $positionName = UserConstant::GROUP_LEADER[1];
        } elseif ($positionId == UserConstant::GENERAL_DIRECTOR[0]) {
            $positionName = UserConstant::GENERAL_DIRECTOR[1];
        }
        return $positionName;
    }

    public function scopeDivisionName($query, $divisionId)
    {
        // find division by id and not null
        $division = Division::where('id', $divisionId)->whereNull('deleted_date')->first();
        return $division->name ?? '';
    }
}
