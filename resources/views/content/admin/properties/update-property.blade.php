@extends('layouts/contentNavbarLayout')

@section('title', 'Update Property')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Update Property</h3>
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
                        <div>
                            <form method="POST" action="{{ route('admin.properties.update', $property->id) }}">
                                @csrf
                                {{-- Owner Selection --}}
                                <div class="mb-6">
                                    <label class="form-label" for="owner_id">Owner</label>
                                    <select class="form-select" id="owner_id" name="owner_id">
                                        <option value="" selected>Select owner</option>
                                        @foreach ($owners as $owner)
                                            <option value="{{ $owner->id }}"
                                                {{ old('owner_id', $property->owner_id) == $owner->id ? 'selected' : '' }}>
                                                {{ format_name($owner->first_name, $owner->last_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('owner_id')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Title --}}
                                <div class="mb-6">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="Beautiful Apartment in City Center"
                                        value="{{ old('title', $property->title) }}" />
                                    @error('title')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Description --}}
                                <div class="mb-6">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="4"
                                        placeholder="Write a brief description of the property">{{ old('description', $property->description) }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Price --}}
                                <div class="mb-6">
                                    <label class="form-label" for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        placeholder="1000000" value="{{ old('price', $property->price) }}"
                                        min="0" />
                                    @error('price')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Status --}}
                                <div class="mb-6">
                                    <label class="form-label" for="status">Status</label>
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="available"
                                            id="available"
                                            {{ old('status', $property->status) == 'available' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="available">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="sold"
                                            id="sold"
                                            {{ old('status', $property->status) == 'sold' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="sold">Sold</label>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Submit and Cancel Buttons --}}
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.properties.view') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary mx-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
