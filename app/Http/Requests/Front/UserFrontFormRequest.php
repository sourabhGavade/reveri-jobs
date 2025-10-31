<?php

namespace App\Http\Requests\Front;

use Auth;
use App\Http\Requests\Request;
use App\Rules\CheckDisposableEmail;

class UserFrontFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = Auth::user()->id;
        $id_str = ',' . $id;

        return [
        'first_name'        => 'required|max:80',
        'middle_name'       => 'nullable|max:80',
        'last_name'         => 'required|max:80',
        'email'             => [
            'required',
            'email',
            'max:100',
            'unique:users,email' . $id_str,
            new CheckDisposableEmail()
        ],
        'password'          => 'required|confirmed|min:6|max:50', // ✅ required + confirmation
        'password_confirmation' => 'required_with:password',
        'father_name'       => 'nullable|max:80',
        'date_of_birth'     => 'required|date|before:today',
        'gender_id'         => 'required',
        'marital_status_id' => 'nullable',
        'nationality_id'    => 'required',
        'national_id_card_number' => 'nullable|max:80',
        'country_id'        => 'required',
        'state_id'          => 'required',
        'city_id'           => 'required',
        'phone'             => 'nullable|max:20',
        'mobile_num'        => 'required|max:15',
        'job_experience_id' => 'required',
        'career_level_id'   => 'required',
        'industry'          => 'required|array',
        'functional_area'   => 'required|array',
        'summary'           => 'required',

        // Optional salary fields
        'current_salary'    => 'nullable|max:11',
        'expected_salary'   => 'nullable|max:11',
        'salary_currency'   => 'nullable|max:5',

        'street_address'    => 'required|max:230',
        'image'             => 'nullable|image',
        ];
    }

    public function messages()
    {
        return [
        'first_name.required' => __('First Name is required'),
        'last_name.required'  => __('Last Name is required'),
        'email.required'      => __('Email is required'),
        'email.email'         => __('The email must be a valid email address'),
        'email.unique'        => __('This Email has already been taken'),

        'password.required'   => __('Password is required'),
        'password.confirmed'  => __('Password confirmation does not match'),
        'password.min'        => __('Password must be at least 6 characters'),
        'password_confirmation.required_with' => __('Please confirm your password'),

        'date_of_birth.required' => __('Date of Birth is required'),
        'date_of_birth.date'     => __('Please enter a valid date'),
        'date_of_birth.before'   => __('Date of Birth must be in the past'),

        'gender_id.required'     => __('Please select gender'),
        'nationality_id.required'=> __('Please select nationality'),
        'country_id.required'    => __('Please select country'),
        'state_id.required'      => __('Please select state'),
        'city_id.required'       => __('Please select city'),

        'mobile_num.required'    => __('Please enter mobile number'),
        'job_experience_id.required' => __('Please select experience'),
        'career_level_id.required'   => __('Please select career level'),
        'industry.required'          => __('Please select at least one industry'),
        'functional_area.required'   => __('Please select at least one functional area'),
        'summary.required'           => __('Summary is required'),

        'street_address.required'    => __('Please enter street address'),
        'image.image'                => __('Only images can be uploaded'),
        ];
    }

}
