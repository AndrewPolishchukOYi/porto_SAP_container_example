<?php

namespace App\Containers\Feedback\Models;

use App\Port\Model\Abstracts\Model;
use App\Containers\User\Models\User;
use App\Containers\Feedback\Models\Criteria;
use App\Containers\Feedback\Models\Feedback;

/**
 * Class Feedback.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class Grade extends Model
{

    const NAME = "Grade";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedback_grades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feedback_id',
        'criteria_id',
        'points'
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
    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }
}
