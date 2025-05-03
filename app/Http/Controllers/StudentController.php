<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\City;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::with('city')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhereHas('city', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('students.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'city_id' => 'required|exists:cities,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $cities = City::orderBy('name')->get();
        return view('students.edit', compact('student', 'cities'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$student->id,
            'city_id' => 'required|exists:cities,id',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}
