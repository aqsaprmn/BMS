<?php

namespace App\Http\Requests;

use App\Models\Customer\CsCustomer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $type = $this->request->get("type");

        $rules = collect([
            'customer_name' => ["required"],
            'identity_no' => ["required"],
            'hp_1' => ["required"],
        ]);

        switch ($type) {
            case 'Apartment':
                $rules = $rules->merge([
                    'apartment' => ["required"],
                    'tower' => ["required"],
                    'floor' => ["required"],
                ]);
                break;

            case 'Landed':
                $rules = $rules->merge([
                    'street' => ["required"],
                    'district_id' => ["required"],
                ]);
                break;
        }

        if ($type != "Enterprise" && $type != "Corporate") {
            $rules = $rules->merge([
                'customer_no' => ["required"],
                'operator_name' => ["required"],
                'place_no' => ["required"],
                'package_id' => ["required"],
            ]);
        } else {
            $rules = $rules->merge([
                'person' => ["required"],
                'service_type' => ["required"],
                'service_taken' => ["required"],
                'price' => ["required"],
                'address' => ["required"],
                'start_date' => ["required"],
                'end_date' => ["required"],
            ]);
        }

        return $rules->all();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "operator_name.required" => ":attribute harus diisi!",
            "person.required" => ":attribute harus diisi!",
            "customer_no.required" => ":attribute harus diisi!",
            "customer_name.required" => ":attribute harus diisi!",
            "identity_no.required" => ":attribute harus diisi!",
            "hp_1.required" => ":attribute harus diisi!",
            "address.required" => ":attribute harus diisi!",
            "street.required" => ":attribute harus diisi!",
            "district_id.required" => ":attribute harus diisi!",
            "block.required" => ":attribute harus diisi!",
            "place_no.required" => ":attribute harus diisi!",
            "package_id.required" => ":attribute harus diisi!",
            "apartment.required" => ":attribute harus diisi!",
            "tower.required" => ":attribute harus diisi!",
            "floor.required" => ":attribute harus diisi!",
            "service_type.required" => ":attribute harus diisi!",
            "service_taken.required" => ":attribute harus diisi!",
            "price.required" => ":attribute harus diisi!",
            "start_date.required" => ":attribute harus diisi!",
            "end_date.required" => ":attribute harus diisi!",
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
            'operator_name' => "Nama Operator",
            'person' => "Nama PIC",
            'customer_no' => "Nomor Pelanggan",
            'customer_name' => "Nama Pelanggan",
            'identity_no' => "No. KTP",
            'hp_1' => "Handphone 1",
            'address' => "Alamat Perusahaan",
            'street' => "Jalan",
            'district_id' => "Kawasan",
            'block' => "Blok",
            'place_no' => "No. Tempat",
            'package_id' => "Paket Layanan",
            'apartment' => "Apartemen",
            'tower' => "Gedung",
            'floor' => "Lantai",
            'service_type' => "Jenis Layanan",
            'service_taken' => "Layanan Yang Diambil",
            'price' => "Harga",
            'start_date' => "Tanggal Mulai",
            'end_date' => "Tanggal Selesai",
        ];
    }
}
