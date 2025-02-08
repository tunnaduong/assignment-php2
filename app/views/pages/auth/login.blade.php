@extends('layouts.default')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin-top: 100px;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container">
        <ul class="nav nav-tabs" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $page == 'login' ? 'active' : '' }}" id="login-tab" data-bs-toggle="tab"
                    data-bs-target="#login" type="button" role="tab">Login</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button"
                    role="tab">Signup</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $page == 'reset' ? 'active' : '' }}" id="forgot-tab" data-bs-toggle="tab"
                    data-bs-target="#forgot" type="button" role="tab">Forgot password?</button>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade {{ $page == 'login' ? 'show active' : '' }}" id="login" role="tabpanel">
                <div class="form-container">
                    @if (!empty($error) && $page == 'login')
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endif
                    <h4 class="text-center">Login</h4>
                    <form method="POST" action="{{ route('login') }}">
                        <input type="hidden" name="login" value="1">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="signup" role="tabpanel">
                <div class="form-container">
                    <h4 class="text-center">Signup</h4>
                    <form method="POST" action="{{ route('login') }}">
                        <input type="hidden" name="signup" value="1">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Signup</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{ $page == 'reset' ? 'show active' : '' }}" id="forgot" role="tabpanel">
                <div class="form-container">
                    @if (!empty($error) && $page == 'reset')
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endif
                    @if (!empty($success) && $page == 'reset')
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    <h4 class="text-center">Forgot password?</h4>
                    <form method="POST" action="{{ route('login') }}">
                        <input type="hidden" name="forgot" value="1">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
