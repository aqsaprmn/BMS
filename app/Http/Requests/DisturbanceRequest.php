<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisturbanceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $action = $this->segment(2);

        $data = collect([]);

        switch ($action) {
            case 'works':
                $data = $data->merge([
                    'work_date' => ["required"],
                    'used_materials' => ["required"],
                    'cause' => ["required"],
                    'work' => ["required"],
                ]);
                break;

            default:
                $data = $data->merge([
                    'disturbance_no' => ["required"],
                    'disturbance_date' => ["required"],
                    'internet_no' => ["required"],
                    'hp_1' => ["required"],
                    'complaint' => ["required"],
                ]);
                break;
        }

        return $data->all();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "disturbance_no.required" => ":attribute harus diisi!",
            "disturbance_date.required" => ":attribute harus diisi!",
            "internet_no.required" => ":attribute harus diisi!",
            "hp_1.required" => ":attribute harus diisi!",
            "complaint.required" => ":attribute harus diisi!",
            "work_date.required" => ":attribute harus diisi!",
            "used_materials.required" => ":attribute harus diisi!",
            "cause.required" => ":attribute harus diisi!",
            "work.required" => ":attribute harus diisi!",
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'disturbance_no' => "Nomor Gangguan",
            'disturbance_date' => "Tanggal Gangguan",
            'internet_no' => "Nomor Internet",
            'hp_1' => "Harga",
            'complaint' => "Tanggal Mulai",
            'work_date' => "Tanggal Pekerjaan",
            'used_materials' => "Material Terpakai",
            'cause' => "Penyebab",
            'work' => "Tindakan",
        ];
    }
}
