<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'division';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'note',
        'name',
        'division_leader_id',
        'division_floor_num',
        'created_date',
        'updated_date',
        'deleted_date'
    ];

    public function scopeDivisionLeaderName($query, $userId)
    {
        // find division by id and not null
        $user = User::where('id', $userId)->whereNull('deleted_date')->first();
        return $user->name ?? '';
    }
}
