<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class AppointmentController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $appointments = Appointment::with(['doctor.specialty', 'user'])
            ->when(Auth::user()->role !== 'admin', function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->orderBy('appointment_date')
            ->get();
            
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('appointments.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
        ]);

        $appointment = new Appointment();
        $appointment->user_id = Auth::id();
        $appointment->doctor_id = $validated['doctor_id'];
        $appointment->appointment_date = $validated['appointment_date'];
        $appointment->appointment_time = $validated['appointment_time'];
        $appointment->save();

        return redirect()->route('appointments.my')->with('success', 'Часът е записан успешно!');
    }

    public function myAppointments()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->with(['doctor.specialty'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('appointments.my-appointments', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.my')
                ->with('error', 'Нямате достъп до този час.');
        }

        $specialties = Specialty::all();
        return view('appointments.edit', compact('appointment', 'specialties'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.my')
                ->with('error', 'Нямате достъп до този час.');
        }

        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.my')
            ->with('success', 'Часът е актуализиран успешно!');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.my')
                ->with('error', 'Нямате достъп до този час.');
        }

        $appointment->delete();

        return redirect()->route('appointments.my')
            ->with('success', 'Часът е изтрит успешно!');
    }

    public function getDoctorsBySpecialty($specialty_id)
    {
        Log::info('Getting doctors for specialty_id: ' . $specialty_id);
        
        $doctors = Doctor::where('specialty_id', $specialty_id)->get();
        Log::info('Found doctors: ' . $doctors->toJson());
        
        return response()->json($doctors);
    }
} 