<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('specialty')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors',
            'phone' => 'required|string|max:20',
            'specialty_id' => 'required|exists:specialties,id',
            'about' => 'nullable|string',
            'working_hours' => 'nullable|string'
        ]);

        Doctor::create($validated);

        return redirect()->route('doctors.index')
            ->with('success', 'Лекарят е добавен успешно.');
    }

    public function edit(Doctor $doctor)
    {
        $specialties = Specialty::all();
        return view('doctors.edit', compact('doctor', 'specialties'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'specialty_id' => 'required|exists:specialties,id',
            'about' => 'nullable|string',
            'working_hours' => 'nullable|string'
        ]);

        $doctor->update($validated);

        return redirect()->route('doctors.index')
            ->with('success', 'Информацията за лекаря е обновена успешно.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')
            ->with('success', 'Лекарят е изтрит успешно.');
    }
} 