<?php

namespace App\Http\Controllers;

use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\ActivityController;
use App\Models\Books;

class BookController extends HelpController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->data()->merge([
            'title' => "Books List",
            'script' => "<script src='assets/js/admin/customer.js'></script>",
            'books' => Books::orderBy('created_at', 'desc')->get()
        ])->all();

        if (session()->has('status')) {
            AlertController::alert(session('status'));
        }

        return view('Menu.Books.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->data()->merge([
            'title' => "Tambah Paket",
        ])->all();

        return view('Menu.Books.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => ['required'],
            'writer' => 'required',
            'publish_year' => ['required', "numeric"],
        ], [
            "title.required" => "Required",
            "title.unique" => "Available",
            "writer.required" => "Required",
            "publish_year.required" => "Required",
            "publish_year.numeric" => "Wrong input"
        ]);

        $data = $this->data()->merge([
            "uuid" => Uuid::uuid()
        ]);

        $data = $data->merge($validateData)->all();

        if (!Books::create($data)) {
            return redirect("/books")->with('status', "failed/Books/Add data failed!");
        }

        if (!ActivityController::create("books", $data["uuid"], "create")) {
            return redirect(url('/books'))->with('status', "failed/Failed/Record activity failed!");
        }

        return redirect("/books")->with('status', "success/Books/Add data success!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Books $book)
    {
        $data = $this->data()->merge([
            'title' => "See book data",
            "book" => $book
        ])->all();

        return view('Menu.Books.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $book)
    {
        $status = [
            [
                'id' => 'A',
                'desc' => 'Available',
            ],
            [
                'id' => 'N',
                'desc' => 'Not Available',
            ],
        ];

        $data = $this->data()->merge([
            'title' => "Edit Book Data",
            "book" => $book,
            'status' =>  $this->ArrInToObj($status)
        ])->all();

        return view('Menu.Books.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $book)
    {
        $validateData = $request->validate([
            'title' => [
                'required',
                Rule::unique('books')->ignore($book->id)
            ],
            'writer' => "required",
            'publish_year' => ['required', "numeric"],
            'status' => 'required'
        ], [
            "title.required" => "Required",
            "title.unique" => "Available",
            "writer.required" => "Required",
            "publish_year.required" => "Required",
            "publish_year.numeric" => "Wrong input"
        ]);

        if (!$book->update($validateData)) {
            return redirect("/books")->with('status', "failed/Books/Update book data failed!");
        }

        if (!ActivityController::create("books", $book->book_id, "update")) {
            return redirect(url('/books'))->with('status', "failed/Failed/Record activity failed!");
        }

        return redirect("/books")->with('status', "success/Books/Update book data success!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $book)
    {
        if (!$book) {
            return redirect("/books")->with('status', "failed/Book/Delete book failed, Data not found!");
        }

        if (!$book->delete() && $book->trashed()) {
            return redirect("/books")->with('status', "failed/Book/Delete book failed!");
        }

        if (!ActivityController::create("books", $book->uuid, "delete")) {
            return redirect(url('/books'))->with('status', "failed/Failed/Record activity failed!");
        }

        return redirect("/books")->with('status', "success/Book/Delete book success!");
    }
}
