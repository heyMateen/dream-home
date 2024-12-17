@extends('layouts/contentNavbarLayout')

@section('title', 'Add Branch')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-header">Add Branch</h3>
                    <a href="{{ route('admin.branches.view') }}">
                        <button type="btn" class="btn btn-secondary">View All</button>
                    </a>
                </div>
                <div class="col-xl card-body">
                    <div class=" mb-6">
                        <div>
                            <form>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-fullname">Full Name</label>
                                    <input type="text" class="form-control" id="basic-default-fullname"
                                        placeholder="John Doe" />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-company">Company</label>
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="ACME Inc." />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="basic-default-email" class="form-control"
                                            placeholder="john.doe" aria-label="john.doe"
                                            aria-describedby="basic-default-email2" />
                                        <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                    </div>
                                    <div class="form-text"> You can use letters, numbers & periods </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-phone">Phone No</label>
                                    <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                        placeholder="658 799 8941" />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-message">Message</label>
                                    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
