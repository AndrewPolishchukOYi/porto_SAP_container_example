<?php

namespace App\Containers\Feedback\Models;

use App\Port\Model\Abstracts\Model;
use App\Containers\User\Models\User;
use App\Containers\Role\Models\Role;
use App\Containers\Feedback\Models\Grade;

/**
 * Class Feedback.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class Criteria extends Model
{

    const NAME = "Criteria";
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedback_criterias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'role_id',
        'points',
        'status'
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany(Grade::class, 'criteria_id');
    }
}
