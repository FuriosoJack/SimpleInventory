<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inventorys' => 'required|array',
            'inventorys.*' => 'array',
            'inventorys.*.id' => 'required|exists:inventorys,id',
            'inventorys.*.quantity' => 'required|integer'
        ];
    }
}
