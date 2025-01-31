<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Query untuk mendapatkan data instructors dengan eager loading
        $instructors = Instructor::with('user') // Eager load user untuk menghindari N+1
            ->when($search, function ($query) use ($search) {
                // Lakukan pencarian berdasarkan nama atau email pengguna
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->paginate(10); // Pagination 10 item per halaman
        return view('instructor.index',compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('instructor.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {
        $validate = $request->validated();

        $data = [
            'name' => $validate['name'],
            'phone' => $validate['phone'],
            'email' => $validate['email'],
            'password' => bcrypt('123'),
            // 'password' => bcrypt(str()->random(10))
        ];

        $user = User::create($data);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('instructor-image','public');
            $validate['image'] = $imagePath;
        }

        // Membuat Instructor terkait dengan User
        $instructor = $user->instructor()->create([ // Menggunakan relasi untuk membuat Instructor
            'gender' => $validate['gender'],
            'photo' => $validate['image'] ?? null, // Jika tidak ada gambar, null
        ]);

        // Menambahkan courses yang dipilih oleh user
        foreach ($validate['course_id'] as $course) {
            // Menambahkan InstructorCourse melalui relasi hasMany
            $instructor->instructor_course()->create([
                'course_id' => $course
            ]);
        }
        $user->assignRole('instructor');
        return redirect()->route('instructor.index')->with('success', 'Instructor created successfully');
        
        // Instructor::create([
        //     'user_id' => $user->id,
        //     'gender' => $validate->gender,
        //     'photo' => $validate->image,
        // ]);

    } 

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        return view('instructor.show',compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        $courses = Course::all();
        return view('instructor.edit',compact('instructor','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $validate = $request->validated();

        $data = [
            'name' => $validate['name'],
            'phone' => $validate['phone'],
            'email' => $validate['email'],
        ];

        $instructor->user->update($data);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($instructor->photo) {
                Storage::disk('public')->delete($instructor->photo);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('instructor-image', 'public');
            $validate['image'] = $imagePath;
            $instructor->update([
                'photo' => $validate['image']
            ]);
        }

        $instructor->update([
            'gender' => $validate['gender'],
        ]);

        // Hapus kursus yang lama
        $instructor->instructor_course()->delete();

        // Menambahkan kursus baru
        foreach ($validate['course_id'] as $course) {
            $instructor->instructor_course()->create([
                'course_id' => $course
            ]);
        }

        return redirect()->route('instructor.show',$instructor)->with('success', 'Instructor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        //
    }
}
