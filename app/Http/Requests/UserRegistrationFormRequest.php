<?php

namespace Modules\AwdisProductWishlist\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationFormRequest extends FormRequest
{
    protected string $redirectMethod = 'POST';

        /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'business_name' => 'required',
            'password' => 'required_if:register,on|confirmed',
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
