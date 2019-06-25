<?php

namespace App\Containers\Feedback\UI\API\Requests\CriteriaRequests;

use Illuminate\Contracts\Auth\Access\Gate;
use App\Containers\Feedback\Models\Criteria;
use App\Port\Request\Abstracts\Request;

/**
 * Class DeleteLevelRequest.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class DeleteFeedbackCriteriaRequest extends Request
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
        $criteria = Criteria::findOrFail($this->id);
        return $gate->getPolicyFor(Criteria::class)->delete($criteria);
    }
}
