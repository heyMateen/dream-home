@extends('layouts/contentNavbarLayout')

@section('title', 'Add User')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Add User</h3>
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
                            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                @csrf
                                {{-- First Name --}}
                                <div class="mb-6">
                                    <label class="form-label" for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="John" value="{{ old('first_name') }}" />
                                    @error('first_name')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Last Name --}}
                                <div class="mb-6">
                                    <label class="form-label" for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Doe" value="{{ old('last_name') }}" />
                                    @error('last_name')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="mb-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="email@example.com" value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Password --}}
                                <div class="mb-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="********" value="{{ old('password') }}" />
                                    @error('password')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div class="mb-6">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="********" />
                                    @error('password_confirmation')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- Phone Number --}}
                                <div class="mb-6">
                                    <label class="form-label" for="phone_number">Phone No</label>
                                    <input type="tel" id="phone_number" class="form-control phone-mask"
                                        placeholder="+923XXXXXXXXXXX" name="phone_number"
                                        value="{{ old('phone_number') }}" />
                                    @error('phone_number')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Address --}}
                                <div class="mb-6">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        placeholder="123 Main Street" value="{{ old('address') }}" />
                                    @error('address')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- City --}}
                                <div class="mb-6">
                                    <label class="form-label" for="city">City</label>
                                    <select class="form-select" name="city" id="city">
                                        <option value="" disabled selected>Select City</option>
                                        @foreach (get_cities() as $city)
                                            <option value="{{ $city }}"
                                                {{ old('city') == $city ? 'selected' : '' }}>{{ ucwords($city) }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- State --}}
                                <div class="mb-6">
                                    <label class="form-label" for="state">State</label>
                                    <select class="form-select" name="state" id="state">
                                        <option value="" disabled selected>Select State</option>
                                        @foreach (get_states() as $state)
                                            <option value="{{ $state }}"
                                                {{ old('state') == $state ? 'selected' : '' }}>{{ ucwords($state) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Postal Code --}}
                                <div class="mb-6">
                                    <label class="form-label" for="postal_code">Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" id="postal_code"
                                        placeholder="Postal Code" value="{{ old('postal_code') }}" />
                                    @error('postal_code')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Role --}}
                                <div class="mb-6">
                                    <label class="form-label" for="role">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                                            Super Admin</option>
                                        <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner
                                        </option>
                                        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client
                                        </option>
                                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Profile Image --}}
                                <div class="mb-4">
                                    <label for="profile_image" class="form-label">Profile Image</label>
                                    <input class="form-control" type="file" name="profile_image" id="profile_image">
                                    <div id="imagePreviewContainer" class="mt-2">
                                        <img id="imagePreview" src="" alt="Profile Image" class="img-fluid"
                                            style="width: 150px; height: 150px; margin-top:10px; border-radius:8px; display: none;">
                                    </div>
                                    @error('profile_image')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="active"
                                            id="activeRadio" {{ old('status', 'active') == 'active' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="activeRadio">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="inactive"
                                            id="inactiveRadio" {{ old('status') == 'inactive' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="inactiveRadio">Inactive</label>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.users.view') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary mx-2">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // JavaScript to show selected image preview
        document.getElementById('profile_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the image
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
