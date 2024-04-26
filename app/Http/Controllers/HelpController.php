<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HelpController extends Controller
{
    protected $data;

    public function data()
    {
        return $this->data = collect([]);
    }

    public function ArrInToObj(array $array)
    {
        if (!is_array($array)) {
            return false;
        }

        foreach ($array as $r) {
            is_array($r) ? $p = (object) $r : $p = $r;
            $new_array[] = $p;
        }

        foreach ($new_array as $r) {
            if (!is_object($r)) {
                return false;
            }
        }

        return $new_array;
    }

    public function ObjToArray(object $object)
    {
        if (!is_object($object)) {
            return false;
        }

        foreach ($object as $r => $value) {
            $new_array[$r] = $value;
        }

        if (!is_array($new_array)) {
            return false;
        }

        return $new_array;
    }

    public function accessPermission($excerpt)
    {
        if (!Permission($excerpt)) {
            abort(403, auth()->user()->role . " tidak dapat akses ini!");
        }

        return true;
    }

    public function isAdmin()
    {
        return auth()->user()->is_admin;
    }

    public function globalActivation($target, $object, $type)
    {
        $status = $object->status;

        $type = Str::ucfirst($type);

        $collObKeys = collect($object)->keys();

        $id = "";

        foreach ($collObKeys as $key => $val) {
            if (Str::contains($val, "_id")) {
                $id = $object->$val;
            }
        }

        switch ($status) {
            case 'A':
                $data["status"] = "N";
                if (!$object->update($data)) {
                    return redirect($target)->with('status', "success/$type/Non-Aktif $type gagal!");
                }

                if (!ActivityController::create($object->getTable(), $id, "update", addition: "Status menjadi Non-Aktif")) {
                    return redirect($target)->with('status', "failed/Gagal/Mencatat aktifitas gagal!");
                }

                return redirect($target)->with('status', "success/$type/Non-Aktif $type berhasil!");
                break;

            default:
                $data["status"] = "A";
                if (!$object->update($data)) {
                    return redirect($target)->with('status', "success/$type/Aktifkan $type gagal!");
                }

                if (!ActivityController::create($object->getTable(), $id, "update", addition: "Status menjadi Aktif")) {
                    return redirect($target)->with('status', "failed/Gagal/Mencatat aktifitas gagal!");
                }

                return redirect($target)->with('status', "success/$type/Aktifkan $type berhasil!");
                break;
        }
    }

    public function statusChecker($type, $status)
    {
        switch ($type) {
            case 'customers':
                $data = [
                    "N" => 1,
                    "D" => 2,
                    "M" => 3,
                    "A" => 4,
                    "V" => 5
                ];
                break;
            default:
                $data = [];
                break;
        }

        if (!Arr::exists($data, $status)) {
            $callback = [];
        }

        $callback = Arr::where($data, function ($value, $key) use ($data, $status) {
            return $value <= Arr::get($data, $status);
        });

        return (object) $callback;
    }

    public function checkSimilarityDataUpdate($request, $object)
    {
        $keys = collect($request)->keys();

        foreach ($keys as $key => $val) {
            if ($request[$val] != $object->$val) {
                return true;
            }
        }

        return false;
    }
}
