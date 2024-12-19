@extends('layouts/contentNavbarLayout')

@section('title', 'Add Staff')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Add Staff</h3>
                </div>
                <div class="mt-2 mb-2">
                    @if (session()->has('success'))
                        <div class="alert alert-success text-success">{{ session()->get('success') }}</div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger text-danger">{{ session()->get('error') }}</div>
                    @endif
                </div>
                <div class="col-xl card-body">
                    <div class="mb-6">
                        <form method="POST" action="{{ route('admin.staff.store') }}">
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="user_id">Available Staff</label>
                                <select class="form-select" id="user_id" name="user_id">
                                    <option value="" selected>Select staff</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" 
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label class="form-label" for="branch_id">Branch</label>
                                <select class="form-select" id="branch_id" name="branch_id">
                                    <option value="" selected>Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label class="form-label" for="role">Role</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                </select>
                                @error('role')
                                    <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md">
                                <label class="form-label" for="status">Status</label>
                                <div class="form-check mt-3">
                                    <input name="status" class="form-check-input" type="radio" value="active" id="active" checked />
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="status" class="form-check-input" type="radio" value="inactive" id="inactive"
                                        {{ old('status') == 'inactive' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="inactive">
                                        Inactive
                                    </label>
                                </div>
                                @error('status')
                                    <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.staff.view') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary mx-2">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
