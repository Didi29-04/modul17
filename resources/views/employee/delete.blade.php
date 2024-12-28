@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mb-3">Delete Confirmation</h4>
            </div>
        </div>
        <hr>
        <div class="alert alert-warning">
            <h5>Are you sure you want to delete this employee?</h5>
            <p>
                <strong>First Name:</strong> {{ $employee->firstname }}<br>
                <strong>Last Name:</strong> {{ $employee->lastname }}<br>
                <strong>Email:</strong> {{ $employee->email }}<br>
                <strong>Position:</strong> {{ $employee->position->name }}<br>
            </p>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </form>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

        <hr>

        <div class="alert alert-danger mt-4">
            <h5>Delete CV</h5>
            <p>If you want to delete the CV associated with this employee, click the button below:</p>
        </div>
        <form action="{{ route('employees.delete_cv', $employee->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">Delete CV</button>
        </form>
    </div>
@endsection
