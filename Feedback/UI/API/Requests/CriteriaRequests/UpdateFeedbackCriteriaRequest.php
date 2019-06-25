<?php

namespace App\Containers\Feedback\UI\API\Requests\CriteriaRequests;

use App\Containers\Feedback\Models\Criteria;
use App\Port\Request\Abstracts\Request;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Class UpdateLevelRequest.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class UpdateFeedbackCriteriaRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|min:2',
            'display_name' => 'string|min:4',
            'description' => 'string|min:4',
            'points' => 'integer',
            'status' => 'integer'
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
        return $gate->getPolicyFor(Criteria::class)->update($this->user(), $criteria, $this);
    }
}
