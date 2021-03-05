<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseCreateRequest extends FormRequest
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
            'attachment' => 'required|mimes:pdf,txt,doc,docx,csv,xls,xlsx|max:2048',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'name' => 'required|max:150'
        ];
    }
}
