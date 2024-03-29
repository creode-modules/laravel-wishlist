<?php

namespace Creode\LaravelWishlist\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserTypeRequest extends FormRequest
{
    private array $acceptedUserTypes = [
        'organisation',
        'printer',
        'embellisher'
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'userType' => ['required', Rule::in($this->acceptedUserTypes)],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
