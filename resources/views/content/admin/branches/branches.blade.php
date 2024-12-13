@extends('layouts/contentNavbarLayout')

@section('title', 'Branches')

@section('content')
    <div class="card">
        <h3 class="card-header">Branches</h3>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Branch Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Manager</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $branch->branch_id }}</td>
                            <td>{{ $branch->branch_name }}</td>
                            <td>{{ substr($branch->address, 0, 30) }}</td>
                            <td>{{ $branch->phone_number }}</td>
                            <td>{{ format_name($branch->manager->first_name, $branch->manager->last_name) }}</td>
                            <td><span
                                    class="badge bg-label-{{ $branch->status == 'active' ? 'success' : 'danger' }} me-1">{{ ucfirst($branch->status) }}</span>
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
                {{ $branches->links() }}
            </div>
        </div>
    </div>

@endsection
