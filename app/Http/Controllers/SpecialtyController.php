<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::withCount('doctors')->get();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialties',
            'description' => 'nullable|string'
        ]);

        Specialty::create($validated);

        return redirect()->route('specialties.index')
            ->with('success', 'Специалността е добавена успешно.');
    }

    public function edit(Specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable|string'
        ]);

        $specialty->update($validated);

        return redirect()->route('specialties.index')
            ->with('success', 'Специалността е обновена успешно.');
    }

    public function destroy(Specialty $specialty)
    {
        if ($specialty->doctors()->count() > 0) {
            return redirect()->route('specialties.index')
                ->with('error', 'Не може да изтриете специалност, която има назначени лекари.');
        }

        $specialty->delete();
        return redirect()->route('specialties.index')
            ->with('success', 'Специалността е изтрита успешно.');
    }
} 