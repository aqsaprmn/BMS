<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    protected $interaction;
    protected $action;

    protected $data;

    protected $sender;
    protected $to;

    public function __construct($to, $interaction, $subject, $header, $action)
    {
        $sender = auth()->user();

        $this->data = collect([
            "subject" => $sender->role . " - " . $subject,
            "header" => $header,
            "action" => $action
        ]);

        $this->sender = $sender;
        $this->to = $to;
        $this->interaction = $interaction;
        $this->action = $action;
    }

    public function process()
    {
        foreach ($this->to as $key => $value) {
            $sendMail = Mail::to($value->email)->send(new MailSend($this->data->all(), $this->interaction, $value));

            if (!$sendMail) {
                return false;
            }
        }

        return true;
    }
}
