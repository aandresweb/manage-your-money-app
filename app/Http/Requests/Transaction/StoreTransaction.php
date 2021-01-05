<?php

namespace App\Http\Requests\Transaction;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTransaction extends FormRequest
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
            //
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'ammount' => $this->ammount,
            'area_id' => $this->area,
            'description' => ucfirst($this->description),
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'user_id' => Auth::user()->id,
            'type' => $this->type
        ]);
    }
}
