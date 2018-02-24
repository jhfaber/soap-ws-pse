<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Generate rules that apply to Person SOAP Structure attributes
     *
     * @param $target
     * @return array
     */
    private function personRules($target)
    {
        return [
            "$target.documentType" => 'required|string|max:3|in:CC,CE,TI,PPN,NIT,SSN',
            "$target.document" => 'required|string|min:8|max:12|regex:/^\d{8,12}$/',
            "$target.firstName" => 'required|string|max:60|regex:/^[a-zA-ZÀ-ž][\sa-zA-ZÀ-ž]*$/',
            "$target.lastName" => 'required|string|max:60|regex:/^[a-zA-ZÀ-ž][\sa-zA-ZÀ-ž]*$/',
            "$target.company" => 'required|string|max:60|regex:/^[a-zA-ZÀ-ž][\sa-zA-ZÀ-ž]*$/',
            "$target.emailAddress" => 'required|email|max:80',
            "$target.address" => 'required|string|max:100',
            "$target.country" => 'required|string|max:2',
            "$target.province" => 'required|string|max:50',
            "$target.city" => 'required|string|max:50',
            "$target.phone" => 'required|string|max:30|regex:/^\d+$/',
            "$target.mobile" => 'required|string|max:30|regex:/^\d+$/',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            "description" => 'required|string|max:255',
            "language" => 'required|string|max:2',
            "currency" => 'required|string|max:3',
            "devolutionBase" => 'required|numeric|min:0',
            "taxAmount" => 'required|numeric|min:0',
            "tipAmount" => 'required|numeric|min:0',
            "totalAmount" => 'required|numeric|min:0',
            "bankInterface" => 'required|string|max:1',
            "bankCode" => 'required|string|max:4',
            "payer" => 'required|array',
            "buyerCheck" => 'sometimes|accepted',
            "buyer" => 'required_without:buyerCheck|array',
            "shippingCheck" => 'sometimes|accepted',
            "shipping" => 'required_without:shippingCheck|array',
        ];

        $rules = array_merge($rules, $this->personRules("payer"));

        if (! $request->has('buyerCheck')) {
            $rules = array_merge($rules, $this->personRules("buyer"));
        }

        if (! $request->has('shippingCheck')) {
            $rules = array_merge($rules, $this->personRules("shipping"));
        }

        return $rules;
    }
}
