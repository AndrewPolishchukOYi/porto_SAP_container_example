<?php

namespace App\Containers\Feedback\UI\API\Requests\CriteriaRequests;

use App\Port\Request\Abstracts\Request;
use App\Containers\Role\Models\Role;

/**
 * Class CreateLevelRequest.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class CreateFeedbackCriteriaRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required|string|min:4|unique:levels,name',
            'display_name'       => 'required|string|min:4',
            'description'       => 'required|string|min:4',
            'points'       => 'required|integer',
            'status'       => 'integer',
            'role_id'       => 'integer',
            'role'       => 'required|array',
            'role.name'       => 'required|string|exists:roles,name',
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
        $data['role_id'] = (int)Role::where('name',$this->get('role')['name'])->first()->id;

        return $data;
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
