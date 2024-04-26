<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AlertController extends HelpController
{
    public static function alert($message)
    {
        $msg = Str::of($message)->explode("/");

        switch ($msg[0]) {
            case 'success':
                Alert::success($msg[1], $msg[2]);
                break;

            case 'info':
                Alert::info($msg[1], $msg[2]);
                break;

            default:
                Alert::error($msg[1], $msg[2]);
                break;
        }
    }
}
