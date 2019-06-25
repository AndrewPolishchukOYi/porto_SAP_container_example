<?php

namespace App\Containers\Feedback\UI\API\Requests;

use Illuminate\Contracts\Auth\Access\Gate;
use App\Containers\Feedback\Models\Feedback;
use App\Port\Request\Abstracts\Request;

/**
 * Class DeleteFeedbackRequest.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class DeleteMultipleFeedbackRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ids' => 'required|array',
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return bool
     */
    public function authorize(Gate $gate)
    {   
        foreach ($this->ids as $key => $id) {
            $feedback = Feedback::findOrFail($id);
            if(!$gate->getPolicyFor(Feedback::class)->delete($this->user(), $feedback)) return false;
        }
        return true;

    }
}
