<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: Implement authorization logic if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:4'],
            'body' => ['required', 'string', 'min:4'],
            ];
        }
            
    /**
     * Here you can customize the error messages for validation failures.
    */

    /** public function messages()
     * {
     *    return [
     *        'title.required' => 'ALERT! The title field is required.',
     *        'body.required' => 'The body field is required.',
     *      ];
     *    }
    */
}
