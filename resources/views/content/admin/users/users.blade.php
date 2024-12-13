@extends('layouts/contentNavbarLayout')

@section('title', 'Users')
@section('styles')
    <style>
        .user-image {
            height: 50px;
            width: 50px;
        }
    </style>

@section('content')
    <div class="card">
        <h3 class="card-header">Users</h3>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ ucwords($user->name) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <img class="rounded-pill user-image" src="{{ $user->profile_image}}"
                                    alt="{{ $user->first_name . ' \'s Image' }}">
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
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

@endsection
