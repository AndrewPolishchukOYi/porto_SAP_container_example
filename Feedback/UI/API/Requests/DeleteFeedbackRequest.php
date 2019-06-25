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
class DeleteFeedbackRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer', // url parameter
        ];
    }

    /**
     * Override the all() to automatically apply validation rules to the URL parameters
     *
     * @return  array
     */
    public function all()
    {
        $data = parent::all();
        $data['id'] = $this->route('id');

        return $data;
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
        $feedback = Feedback::findOrFail($this->id);
        return $gate->getPolicyFor(Feedback::class)->delete($this->user(), $feedback);
    }
}
