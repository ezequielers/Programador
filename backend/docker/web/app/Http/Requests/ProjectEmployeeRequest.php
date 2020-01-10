<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ProjectEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "project_id" => "required|integer",
            "employee_id" => "required|integer",
            "manager" => "required|integer|in:0,1"
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'project_id.required' => 'Project Id is required',
            'project_id.integer' => 'Inform an integer value',
            'employee_id.required' => 'Employee Id is required',
            'employee_id.integer' => 'Inform an integer value',
            'manager.required' => 'Inform if employee is manager',
            'manager.integer' => 'Inform an integer value',
            'manager.in' => 'Please inform on of this numbers: :values'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
