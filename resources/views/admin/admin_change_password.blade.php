@extends('admin.admin_master')
@section('title', 'E-Commerce')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Change Password Page</h4><br>

                        {{-- Display success message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Display error message --}}
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Display validation errors --}}
                        @if (count($errors))
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">
                                    {{ $error }}
                                </p>
                            @endforeach
                        @endif

                        <form method="POST" action="{{ route('update.password') }}">
                            @csrf
                            <!-- Old Password -->
                            <div class="row mb-3">
                                <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="old_password" type="password" id="old_password" placeholder="Enter old password">
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="row mb-3">
                                <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="new_password" type="password" id="new_password" placeholder="Enter new password">
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="row mb-3">
                                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="confirm_password" type="password" id="confirm_password" placeholder="Re-enter new password">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <input type="submit" class="btn btn-primary" value="Change Password" />
                        </form>
                        <!-- end form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
