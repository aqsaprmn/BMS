<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HelpController;

class ProfileController extends HelpController
{
    /**
     * Show the form for creating the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $key = $request->image;
        $user_id = $request->user_id;

        $path = "uploads/user/";

        $image_exp = explode(";base64,", $key);

        $image_aux = explode("image/", $image_exp[0]);

        $image_type = $image_aux[1];

        $image_base64 = base64_decode($image_exp[1]);

        $filename = $user_id . "_" . strtotime(date("Y-m-d H:i:s")) .  "." .  $image_type;

        $image_full_path = $path . $filename;

        if (!Storage::put($image_full_path, $image_base64)) {
            return response()->json([
                "result" => "error",
                "message" => "Gagal mengganti poto profil.",
            ], 500);
        }

        $data = [
            "image" => $filename
        ];

        $userToUpdate = User::where("user_id", $user_id)->first();

        $updImageUser = $userToUpdate->update($data);

        if (!$updImageUser) {
            return response()->json([
                "result" => "error",
                "message" => "User tidak tersedia.",
            ], 500);
        }

        return response()->json([
            "result" => "success",
            "message" => "Berhasil mengganti poto profil.",
            "data" => [
                "file_full_path" => "storage/" . $image_full_path
            ],
        ], 200);
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        abort(404);
    }

    /**
     * For look data profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $data = $this->data()->merge([
            'title' => "Profil Saya",
        ])->all();

        if (session()->has('status')) {
            AlertController::alert(session('status'));
        }

        return view('Auth.profile', $data);
    }

    /**
     * Update data profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        $request->validate($reqValidate->all(), $msgValidate->all());

        $dataUpdate = Arr::map($request->only("name", "email", "hp"), function ($val, $key) {
            return Str::of($val)->trim();
        });

        $data = $this->data()->merge($dataUpdate);

        if (!$user->update($data->all())) {
            return redirect("/profile")->with("status", "failed/Gagal/Gagal update data pengguna!");
        }

        return redirect("/profile")->with("status", "success/Sukses/Berhasil update data pengguna!");
    }
}
