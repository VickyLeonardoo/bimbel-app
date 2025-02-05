<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildrenRequest;
use App\Http\Requests\UpdateChildrenRequest;
use Illuminate\Http\Request;
use App\Models\Children; 

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Children::query()
        ->where('user_id', auth()->user()->id);

        // Search berdasarkan nama
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan range umur
        if ($request->has('age_range')) {
            switch ($request->age_range) {
                case '5-10':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 5 AND 10');
                    break;
                case '11-15':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 11 AND 15');
                    break;
                case '16-18':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 16 AND 18');
                    break;
            }
        }

        // Tambahkan filter untuk kelas jika diperlukan
        if ($request->has('grade')) {
            $query->where('grade', $request->grade);
        }

        // Tambahkan filter untuk jenis kelamin jika diperlukan
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        // Pagination untuk performa yang lebih baik
        $childrens = $query->latest()->paginate(10);

        // Untuk mempertahankan filter saat pagination
        $childrens->appends($request->all());

        return view('frontend.child.index', compact('childrens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.child.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChildrenRequest $request)
    {
        $validate = $request->validated();
        $user = auth()->user();
        
        $user->childs()->create([
            'name' => $validate['name'],
            'gender' => $validate['gender'],
            'birthdate' => $validate['birthdate'],
            'school' => $validate['school'],
            'grade' => $validate['grade'],
            // 'image' => $validate['image']
        ]);

        return redirect()->route('client.children.index')->with('success','Data anak berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Children $children)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Children $child)
    {
        return $child;
        return view('frontend.child.edit', compact('child'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildrenRequest $request, Children $child)
    {
        $validate = $request->validated();

        $child->update([
            'name' => $validate['name'],
            'gender' => $validate['gender'],
            'birthdate' => $validate['birthdate'],
            'school' => $validate['school'],
            'grade' => $validate['grade'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Children $child)
    {
        $child->delete();
        return redirect()->route('client.children.index')->with('success','Data anak berhasil dihapus');
    }
}
