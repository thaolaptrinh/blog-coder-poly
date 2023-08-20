<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'title' => 'required|string',
            'slug' => 'required|string|unique:posts,slug,' . $this->post->id,
            'body' => 'nullable',
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => ['required', Rule::in(PostStatus::getValues())],
        ];
    }
}