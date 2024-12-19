@extends('layouts/contentNavbarLayout')

@section('title', 'Staff')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Staff</h3>
                    <a class="btn btn-primary" href="{{ route('admin.staff.create.view') }}">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        Add Staff
                    </a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success text-success">{{ session()->get('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger text-danger">{{ session()->get('error') }}</div>
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($staff_members as $staff)
                                <tr>
                                    <td>{{ $staff->id }}</td>
                                    <td>{{ ucfirst($staff->user->first_name) }}</td> <!-- Displaying first name -->
                                    <td>{{ ucfirst($staff->user->last_name) }}</td> <!-- Displaying last name -->
                                    <td>{{ $staff->user->email }}</td> <!-- Displaying email -->
                                    <td>{{ ucfirst($staff->role) }}</td> <!-- Displaying role: manager/employee -->
                                    <td><span
                                            class="badge bg-label-{{ $staff->status == '1' ? 'success' : 'danger' }} me-1">{{ ucfirst($staff->status == '1' ? 'active' : 'inactive') }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.staff.update.view', ['staff' => $staff]) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.staff.delete', ['staff_id' => $staff->id]) }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mx-2">
                    <div class="mt-2 mb-2">
                        {{ $staff_members->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
