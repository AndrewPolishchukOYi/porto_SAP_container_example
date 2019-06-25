<?php

namespace App\Containers\Feedback\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class CreateFeedbackRequest.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class CreateFeedbacksRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'feedbacks' => "required|array",
            'feedbacks.*.recommendation' => "required_if:feedbacks.*.attend,true|string|min:10",
            'feedbacks.*.comment' => "string|min:10",
            'feedbacks.*.attend' => "required|boolean",
            'feedbacks.*.recipient_id' => "required|integer",
            'feedbacks.*.lesson_id' => "required|integer",
            'feedbacks.*.user_id' => "integer",
            'feedbacks.*.ranges' => "required_if:feedbacks.*.attend,true|array",
            'feedbacks.*.ranges.*.id' => "required|integer",
            'feedbacks.*.ranges.*.points' => "required|integer",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
