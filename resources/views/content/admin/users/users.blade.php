@extends('layouts/contentNavbarLayout')

@section('title', 'Users')
@section('styles')
    <style>
        .user-image {
            height: 50px;
            width: 50px;
        }

        .user-address,
        .user-name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            /* Adjust as needed */
        }
    </style>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Users</h3>
                    <a class="btn btn-primary" href="{{ route('admin.users.create.view') }}">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        Add User
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td class="user-name">{{ format_name($user->first_name, $user->last_name) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="user-address">
                                        {{-- Use the format_address helper to display the address --}}
                                        {{ format_address($user->address, $user->city, $user->state) }}
                                    </td>
                                    <td>
                                        <img class="rounded-pill user-image" src="{{ $user->profile_image }}"
                                            alt="{{ $user->first_name . ' \'s Image' }}">
                                    </td>
                                    <td><span
                                            class="badge bg-label-{{ $user->status == '1' ? 'success' : 'danger' }} me-1">{{ ucfirst($user->status == '1' ? 'active' : 'inactive') }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('admin.users.update.view', ['user_id'=> $user->id])}}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="{{route('admin.users.delete', $user->id)}}"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Delete</a>
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
