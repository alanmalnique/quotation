<?php

namespace App\Http\Validator;

use App\Enum\CurrencyEnum;
use App\Rules\AgeCustomRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class QuotationRequestValidator extends FormRequest
{
    public function rules(): array
    {
        return [
            'age' => ['required', 'string', new AgeCustomRule],
            'currency_id' => ['string', 'required', 'exists:currencies,iso_code'],
            'start_date' => ['date', 'required', 'before_or_equal:end_date'],
            'end_date' => ['date', 'required', 'after_or_equal:start_date'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()->messages()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
