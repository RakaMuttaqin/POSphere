<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaryawanRequest extends FormRequest
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
        // dd($this->all());
        return [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'tanggal' => 'required|date',
        ];
    }
}
