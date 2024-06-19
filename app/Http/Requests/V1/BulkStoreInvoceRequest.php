<?php

namespace App\Http\Requests\V1;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId' => ['required', 'integer'],
            '*.amount' => ['required', 'numeric'],
            '*.status' => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
            '*.billedDate' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $value)
        {
            $value['customer_id'] = $value['customerId'] ?? null;
            $value['billed_date'] = $value['billedDate'] ?? null;
            $value['paid_date'] = $value['paidDate'] ?? null;

            $data[] = $value;
        }

        $this->merge($data);
    }
}
