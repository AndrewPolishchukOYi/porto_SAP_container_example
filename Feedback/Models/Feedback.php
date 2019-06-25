<?php

namespace App\Containers\Feedback\Models;

use App\Containers\CourseClass\Models\Lesson;
use App\Port\Model\Abstracts\Model;
use App\Containers\User\Models\User;
use App\Containers\Feedback\Models\Grade;
use App\Containers\Comment\Models\Comment;
use App\Containers\Comment\Traits\CommentTrait;

/**
 * Class Feedback.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class Feedback extends Model
{
    use CommentTrait;

    const NAME = "Feedback";
    const METHODS_WITH_COMMENTS = [];
    const STATUS_NOT_VIEW = 0;
    const STATUS_VIEWED = 1;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'lesson_id',
        'recipient_id',
        'attend',
        'comment_id',
        'recommendation_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany(Grade::class, 'feedback_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recommendation()
    {
        return $this->belongsTo(Comment::class, 'recommendation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

}
