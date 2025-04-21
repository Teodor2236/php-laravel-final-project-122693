@extends('layouts.app')

@section('content')
<div class="container-register">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Моите записани часове</h2>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Запиши нов час</a>
    </div>
    <hr>

    @if($appointments->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Дата</th>
                        <th>Час</th>
                        <th>Специалност</th>
                        <th>Лекар</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->appointment_time }}</td>
                            <td>{{ $appointment->doctor->specialty->name }}</td>
                            <td>{{ $appointment->doctor->name }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('appointments.edit', $appointment) }}" 
                                       class="btn btn-sm btn-outline-primary">Редактирай</a>
                                    
                                    <form action="{{ route('appointments.destroy', $appointment) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Сигурни ли сте, че искате да изтриете този час?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-1">Изтрий</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-4">
            <p class="mb-0">Нямате записани часове.</p>
            <a href="{{ route('appointments.create') }}" class="btn btn-primary mt-3">Запишете своя първи час</a>
        </div>
    @endif
</div>
@endsection 