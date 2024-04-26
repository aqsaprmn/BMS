<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends HelpController
{

    public function updateProfile(Request $request, User $user)
    {


        $reqValidate = collect([
            'name' => ["required"],
            'email' => ["required"],
            'hp' => ['numeric'],
        ]);

        $msgValidate = collect([
            'name.required' => "Nama harus diisi!",
            'email.required' => "Email harus diisi!",
            'hp.numeric' => "HP harus berisi angka!",
        ]);

        if ($request->file("image")) {
            $reqValidate = $reqValidate->merge([
                "image" => ['image', 'mimes:jpg,png,jpeg', 'max:2048']
            ]);
            $msgValidate = $msgValidate->merge([
                'image.image' => "Foto Profil harus berupa gambar!",
                'image.mimes' => "Foto Profil harus berformat PNG/JPG/JPEG",
                'image.max' => "Foto Profil yang berukuran dibawah dari 2mb"
            ]);
        }

        $request->validate($reqValidate->all(), $msgValidate->all());

        $data = $this->data()->merge($request->all("name", "email", "hp"));

        if ($request->has("image")) {
            $path = "uploads/user/";

            $filename = $user->user_id . "." . $request->file("image")->getClientOriginalExtension();

            if (file_exists($path . $filename)) {
                unlink($path . $filename);
            }

            if ($request->file("image")->storeAs($path, $filename)) {
                $data = $data->merge(["image" => $filename]);
            }
        }

        if (!$user->update($data->all())) {
            return redirect("/profile")->with("status", "failed/Gagal/Gagal update data pengguna!");
        }

        return redirect("/profile")->with("status", "success/Sukses/Berhasil update data pengguna!");
    }
}
