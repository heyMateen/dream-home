@extends('layouts/contentNavbarLayout')

@section('title', 'Properties')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Properties</h3>
                    <a class="btn btn-primary" href="{{ route('admin.properties.create.view') }}">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        Add Property
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
                                <th>Owner</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($properties as $property)
                                <tr>
                                    <td>{{ $property->id }}</td>
                                    <td>{{ format_name($property->owner->first_name, $property->owner->last_name) }}</td>
                                    <td>{{ $property->title }}</td>
                                    <td>{{ Str::limit($property->description, 30) }}</td>
                                    <td>{{ '$' . number_format($property->price, 2) }}</td>
                                    <td><span
                                            class="badge bg-label-{{ $property->status == 'available' ? 'success' : 'danger' }} me-1">{{ ucfirst($property->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.properties.update.view', $property->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.properties.delete', $property->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Delete</a>
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
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
