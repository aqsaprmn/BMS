<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create($interactionsTable = "", $interactionsId = NULL, $type = "", $desc = "", $addition = "")
    {
        $data = collect([
            "activity_id" => Uuid::uuid(),
            "user_id" => auth()->user()->user_id,
            "interaction_table" => $interactionsTable,
            "interaction_id" => $interactionsId,
            "type" => $type,
        ]);

        if ($interactionsId != NULL) {
            if ($type == "create") {
                $desc = auth()->user()->name . " Membuat - data " . $interactionsTable . " - ID#" . $interactionsId;
            } else if ($type == "update") {
                if ($addition != "") {
                    $desc = auth()->user()->name . " Update - " . $addition . " data " . $interactionsTable . " - ID#" . $interactionsId;
                } else {
                    $desc = auth()->user()->name . " Update - data " . $interactionsTable . " - ID#" . $interactionsId;
                }
            } else if ($type == "delete") {
                $desc = auth()->user()->name . " Menghapus - " . " data " . $interactionsTable . " - ID#" . $interactionsId;
            }
        } else {
            $desc = auth()->user()->name . " " . $desc;
        }

        $data = $data->merge([
            "desc" => $desc
        ]);

        if (!Activity::create($data->all())) {
            return false;
        }

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
