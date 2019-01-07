<?php

namespace App\Http\Requests\Proposal;

use Illuminate\Foundation\Http\FormRequest;

class ProposalStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'message' => 'required',
            'attached_file' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => __('validation.required', ['attribute' => 'title']),
            'title.string' => __('validation.string', ['attribute' => 'title']),
            'title.max' => __('validation.max.string', ['attribute' => 'title']),
            'message.string' => __('validation.string', ['attribute' => 'text']),

        ];
    }
}
