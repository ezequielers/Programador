<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|max:150",
            "description" => "required|max:1000",
            "dt_start" => "required|date_format:Y-m-d",
            "dt_end" => "required|date_format:Y-m-d",
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
			'name.required' => 'A name is required',
			'name.max'  => 'Maximum of :max characters',
			
			'description.required' => 'A description is required',
			'description.max'  => 'Maximum of :max characters',
			
			'dt_start.required' => 'A start date is required',
			'dt_start.date_format' => 'Input date in format YYYY-MM-DD',
			'dt_end.required'  => 'A end date is required',
			'dt_end.date_format'  => 'Input date in format YYYY-MM-DD'
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
