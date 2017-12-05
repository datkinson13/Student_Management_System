<?php

namespace App\Http\Requests;

use App\Employer;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Make use of the 'can' method that calls the appropriate policy and checks for the users access.
        return $this->user()->can('create', Employer::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validators = [
            'domain'  => 'nullable|size:0',
            'company' => 'required|string|unique:employers',
            'address' => 'required|string|unique:employers',
            'phone'   => 'required|alpha_num|unique:employers|between:10,12', // Must include local area code.
        ];

        if ($this->auto_enroll) {
            $validators['domain'] = 'required|url|unique:employers';
        }

        return $validators;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $suggestedDomain = explode('@',$this->user()->email)[1];
        return [
            'phone.between' => 'The phone must be between 10 and 12 digits. Please ensure you have included the local area code.',
            'domain.required' => 'Domain is required for auto enrollment, this should be everything after the @ in your email. Your suggested domain is: ' . $suggestedDomain,
            'domain.url'  => 'The domain format is invalid, this should be everything after the @ in your email. Your suggested domain is: ' . $suggestedDomain,
        ];
    }
}
