@extends('layouts.app')

@section('content')
<div class="container-register">
    <h2 class="text-center mb-4">Запазване на час</h2>
    <hr>
    
    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="specialty" class="form-label"><b>Изберете специалност</b></label>
            <select name="specialty" id="specialty" class="form-select" required>
                <option value="">-- Изберете специалност --</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="doctor_id" class="form-label"><b>Изберете лекар</b></label>
            <select name="doctor_id" id="doctor_id" class="form-select" required>
                <option value="">-- Първо изберете специалност --</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="appointment_date" class="form-label"><b>Дата</b></label>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="appointment_time" class="form-label"><b>Час</b></label>
            <select name="appointment_time" id="appointment_time" class="form-select" required>
                <option value="">-- Изберете час --</option>
                @foreach(['09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00'] as $time)
                    <option value="{{ $time }}">{{ $time }}</option>
                @endforeach
            </select>
        </div>

        <hr>

        <div class="form-group d-flex justify-content-between">
            <a href="{{ route('appointments.my') }}" class="btn btn-secondary">Отказ</a>
            <button type="submit" class="btn btn-primary">Запази час</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const specialtySelect = document.getElementById('specialty');
    const doctorSelect = document.getElementById('doctor_id');
    
    specialtySelect.addEventListener('change', function() {
        const specialtyId = this.value;
        
        // Изчистваме списъка с лекари
        doctorSelect.innerHTML = '<option value="">-- Изберете лекар --</option>';
        
        if (specialtyId) {
            // Заявка към сървъра за лекарите от избраната специалност
            fetch(`/doctors/by-specialty/${specialtyId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(doctors => {
                doctors.forEach(doctor => {
                    const option = new Option(doctor.name, doctor.id);
                    doctorSelect.add(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                doctorSelect.innerHTML = '<option value="">Грешка при зареждане на лекарите</option>';
            });
        }
    });
});
</script>
@endpush
@endsection 