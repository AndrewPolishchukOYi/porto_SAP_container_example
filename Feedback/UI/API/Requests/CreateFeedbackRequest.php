<?php

namespace App\Containers\Feedback\UI\API\Requests;

use App\Containers\Feedback\Models\Feedback;
use App\Port\Request\Abstracts\Request;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Class CreateFeedbackRequest.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class CreateFeedbackRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recommendation' => "required_if:attend,true|string|min:10",
            'comment' => "string|min:10",
            'attend' => "boolean",
            'validate' => "boolean",
            'recipient_id' => "required|integer",
            'lesson_id' => "required|integer",
            'ranges' => "required_if:attend,true|array",
            'ranges.*.id' => "required|integer",
            'ranges.*.points' => "required|integer",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Gate $gate)
    {
        return $gate->getPolicyFor(Feedback::class)->create($this->user(), $this->all());
    }
}
