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
class DeleteMultipleFeedbackCriteriaRequest extends Request
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
            $criteria = Criteria::findOrFail($id);
            if(!$gate->getPolicyFor(Criteria::class)->delete($criteria)) return false;
        }
        return true;

    }
}
