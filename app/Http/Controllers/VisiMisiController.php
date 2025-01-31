<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisiMisiRequest;
use App\Models\Instructor;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $visimisi = VisiMisi::query();

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $visimisi = $visimisi->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            });
        }

        $visimisi = $visimisi->paginate(10);
        return view('visi-misi.index',compact('visimisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visi-misi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisiMisiRequest $request)
    {
        $validate = $request->validated();

        VisiMisi::create([
            'name' => $validate['name'],
            'type' => $validate['type'],
        ]);
        return redirect()->route('visi-misi.index')->with('success','Data successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();
        return redirect()->back()->with('success','Data successfully deleted');
    }
}
