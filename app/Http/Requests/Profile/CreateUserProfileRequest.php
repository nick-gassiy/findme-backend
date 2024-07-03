<?php

namespace App\Http\Requests\Profile;

use App\Rules\AdultValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:16'],
            'last_name' => ['required', 'max:16'],
            'bio' => ['string', 'max:255'],
            'date_of_birth' => ['required', 'date', new AdultValidationRule],
        ];
    }
}
