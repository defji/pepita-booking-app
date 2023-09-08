<?php

namespace App\Http\Requests;

use App\Rules\OutsideBusinessTime;
use App\Rules\ValidPeriod;
use Illuminate\Foundation\Http\FormRequest;

class AddEventRequest extends FormRequest
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
            'title' => 'required',
            'start' => [
                'required',
                'before:end',
                new OutsideBusinessTime(),
            ],
            'end'   => [
                'required',
                'after:start',
                new ValidPeriod(),
                new OutsideBusinessTime(),
            ],
        ];

    }
}
