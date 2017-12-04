<?php

namespace App\Http\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourse extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Make use of the 'can' method that calls the appropriate policy and checks for the users access.
        return $this->user()->can('create', Course::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|string',
            'subtitle'    => 'nullable|string',
            'description' => 'required|string',
            'StartDate'   => 'required|date',
            'EndDate'     => 'required|date',
            'CourseTime'  => 'required|string',
            'days_valid'  => 'required|string',
            'cost'        => 'required|string',
            'visible'     => 'nullable|boolean',
        ];
    }
}
