@extends('layouts/contentNavbarLayout')

@section('title', 'Update Branch | '.$branch->name)
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Update Branch</h3>
                </div>
                <div class="mt-2 mb-2">
                    @if (session()->has('error'))
                        <div class="alert alert-danger text-danger">{{ session()->get('error') }}</div>
                    @endif
                </div>
                <div class="col-xl card-body">
                    <div class=" mb-6">
                        <div>
                            <form method="POST" action="{{ route('admin.branches.update', ['branch_id' => $branch->id]) }}">
                                @csrf
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-fullname">Name</label>
                                    <input type="text" class="form-control" name="name" id="basic-default-fullname"
                                        placeholder="Lahore Branch" value="{{ old('name', $branch->name) }}" />
                                    @error('name')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <input type="email" id="basic-default-email" class="form-control" placeholder=""
                                            aria-label="john.doe" aria-describedby="basic-default-email2" name="email"
                                            value="{{ old('email', $branch->email) }}" />
                                    </div>
                                    <div class="form-text"> You can use letters, numbers & periods </div>
                                    @error('email')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-phone">Phone No</label>
                                    <input type="tel" id="basic-default-phone" class="form-control phone-mask"
                                        placeholder="+923XXXXXXXXXXX" name="phone_number"
                                        value="{{ old('phone_number', $branch->phone_number) }}" />
                                    @error('phone_number')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-company">Address</label>
                                    <input type="text" class="form-control" name="address" id="basic-default-company"
                                        placeholder="MM Alam Road" value="{{ old('address', $branch->address) }}" />
                                    @error('address')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="city" class="form-label">City</label>
                                    <select class="form-select" id="city" aria-label="Default select example"
                                        name="city">
                                        <option value="" selected>Select city</option>
                                        @foreach (get_cities() as $city)
                                            <option value="{{ $city }}"
                                                {{ old('city') || $branch->city == $city ? 'selected' : '' }}>{{ ucfirst($city) }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" aria-label="Default select example"
                                        name="state">
                                        <option value="" selected>Select state</option>
                                        @foreach (get_states() as $state)
                                            <option value="{{ $state }}"
                                                {{ old('state') || $branch->state == $state ? 'selected' : '' }}>{{ ucfirst($state) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-company">Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" id="basic-default-company"
                                        placeholder="56000" value="{{ old('postal_code', $branch->postal_code) }}" />
                                    @error('postal_code')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="basic-default-company">Status</label>
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="active"
                                            id="defaultRadio1" checked />
                                        <label class="form-check-label" for="defaultRadio1">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="inactive"
                                            id="defaultRadio2" {{ old('status') == 'inactive' || $branch->status == '0' ? 'selected' : '' }} />
                                        <label class="form-check-label" for="defaultRadio2">
                                            Inactive
                                        </label>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger mt-2 mb-1 text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.branches.view') }}" class="btn btn-secondary">Back</a>
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
