<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Borrow;
use App\Models\History;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        $borrow = new Borrow;

        if (request('search') && Gate::allows('isUser')) {
            $borrow = $borrow->whereHas('book', function (Builder $query) {
                $query->where('title', 'like', '%' . request('search') . '%');
            });
        }else{
            $borrow = $borrow->where('kode_peminjaman', 'like', '%' . request('search') . '%');
        }

        if (Gate::allows('isUser')) {
            $title .= 'Borrowing';
            $borrow = $borrow->where('user_id', auth()->user()->id)->get();
        }
        if (Gate::allows('isAdmin')) {
            $title .= 'All Borrowing';
            $borrow = $borrow->orderByDesc('status')->get();
        }

        return view('borrow.borrow', [
            'title' => $title,
            'borrows' => $borrow
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id' => 'required',
            'book_id' => 'required',
            'kode_peminjaman' => 'required',
            'status' => 'required'
        ]);
        $book = Books::where('id', $request->book_id)->first();
        $b_update = $book->update([
            'stok' => $book->stok - 1
        ]);
        if ($b_update) {
            Borrow::create($validateData);
            History::create([
                'user_id' => $validateData['user_id'],
                'books_id' => $validateData['book_id'],
            ]);
            return back()->with('successMessage', 'Buku berhasil dipinjam');
        }
        return back()->with('errorMessage', 'Buku gagal dipinjam');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrow $borrow)
    {
        $borrow_update = $borrow->update([
            'status' => $request->status
        ]);
        if ($borrow_update) {
            $book_update = Books::where('id', $request->book_id)->first();
            $book_update = $book_update->update([
                'stok' => $book_update->stok + 1 
            ]);
            return $borrow_update ? back()->with('successMessage', 'Proses pengembalian berhasil') : back()->with('errorMessage', 'Proses pengembalian gagal');
        }
        return back()->with('errorMessage', 'Proses pengembalian gagal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
