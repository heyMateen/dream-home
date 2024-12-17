@extends('layouts/contentNavbarLayout')

@section('title', 'Branches')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Branches</h3>
                    <a class="btn btn-primary" href="{{ route('admin.branches.create.view') }}">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        Add Branch
                    </a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Branch Name</th>
                                <th>Address</th>
                                <th>Postal Code</th>
                                <th>Country</th>
                                <th>Phone Number</th>
                                <th>Manager</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($branches as $branch)
                                <tr>
                                    <td>{{ $branch->id }}</td>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ format_address($branch->address, $branch->city, $branch->state) }}
                                    </td>
                                    <td>{{ $branch->postal_code }}</td>
                                    <td>{{ $branch->country }}</td>
                                    <td>{{ $branch->phone_number }}</td>
                                    <td>{!! format_name($branch->manager->user->first_name ?? '', $branch->manager->user->last_name ?? '') !!}
                                    </td>
                                    <td><span
                                            class="badge bg-label-{{ $branch->status == '1' ? 'success' : 'danger' }} me-1">{{ ucfirst($branch->status == '1' ? 'active' : 'inactive') }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
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
                        {{ $branches->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
