@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.inner_page_title', ['page_title'=>__('Email Verification')])

<div class="about-wraper" style="padding: 30px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                <div class="email-verification-card">
                    <div class="verification-icon">
                        <i class="fa fa-envelope-o"></i>
                    </div>

                    <h3 class="verification-title">Verify Your Email to Access Dashboard</h3>
                    
                    @if(session('error'))
                        <div class="alert alert-info verification-alert">
                            <i class="fa fa-info-circle"></i> {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success verification-alert">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="verification-content">
                        <p class="verification-subtitle">Almost there!</p>
                        
                        <p class="verification-text">
                            We've sent a verification link to<br>
                            @if(Auth::check())
                                <strong class="user-email">{{ Auth::user()->email }}</strong>
                            @endif
                        </p>

                        <p class="verification-instruction">
                            Click the link in your email to verify your account and start using all features.
                        </p>
                    </div>

                    <div class="verification-actions">
                        @if(Auth::check())
                            <form method="POST" action="{{ route('email-verification.resend') }}" class="verification-form">
                                @csrf
                                <button type="submit" class="btn btn-verification btn-primary">
                                    <i class="fa fa-paper-plane"></i> Resend Verification Email
                                </button>
                            </form>
                        @endif

                        <a href="{{url('/')}}" class="btn btn-verification btn-default">
                            <i class="fa fa-arrow-left"></i> Back to Home
                        </a>

                        @if(Auth::check())
                            <div class="verification-logout">
                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                   class="logout-link">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.about-wraper {
    min-height: auto !important;
}

.email-verification-card {
    background: #ffffff !important;
    border-radius: 8px;
    padding: 40px 35px !important;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1) !important;
    text-align: center !important;
    margin: 0 auto !important;
    max-width: 100%;
    float: none !important;
    display: block !important;
}

.row {
    display: flex !important;
    justify-content: center !important;
}

.verification-icon {
    margin-bottom: 20px;
    text-align: center !important;
}

.verification-icon i {
    font-size: 60px;
    color: #28a745;
    opacity: 0.8;
}

.verification-title {
    color: #333 !important;
    font-size: 24px !important;
    font-weight: 600 !important;
    margin-bottom: 25px !important;
    line-height: 1.3 !important;
    text-align: center !important;
}

.verification-alert {
    margin: 15px 0 !important;
    padding: 12px !important;
    border-radius: 5px;
    text-align: center !important;
}

.verification-content {
    margin: 25px 0 !important;
    text-align: center !important;
}

.verification-subtitle {
    font-size: 18px !important;
    color: #28a745 !important;
    font-weight: 600 !important;
    margin-bottom: 12px !important;
    text-align: center !important;
}

.verification-text {
    font-size: 15px !important;
    color: #555 !important;
    margin-bottom: 18px !important;
    line-height: 1.6 !important;
    text-align: center !important;
}

.user-email {
    color: #28a745 !important;
    font-weight: 600 !important;
    font-size: 16px !important;
}

.verification-instruction {
    font-size: 14px !important;
    color: #777 !important;
    line-height: 1.5 !important;
    text-align: center !important;
}

.verification-actions {
    margin-top: 30px !important;
}

.verification-form {
    margin-bottom: 12px;
}

.btn-verification {
    width: 100% !important;
    padding: 14px 25px !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    border-radius: 5px !important;
    margin-bottom: 10px !important;
    transition: all 0.3s ease;
    border: none !important;
    display: block !important;
}

.btn-verification.btn-primary {
    background-color: #28a745 !important;
    color: white !important;
}

.btn-verification.btn-primary:hover {
    background-color: #218838 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40,167,69,0.3);
}

.btn-verification.btn-default {
    background-color: #6c757d !important;
    color: white !important;
}

.btn-verification.btn-default:hover {
    background-color: #5a6268 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108,117,125,0.3);
}

.btn-verification i {
    margin-right: 6px;
}

.verification-logout {
    margin-top: 20px !important;
    padding-top: 15px !important;
    border-top: 1px solid #e9ecef !important;
    text-align: center !important;
}

.logout-link {
    color: #6c757d !important;
    font-size: 14px !important;
    text-decoration: none;
    transition: color 0.3s ease;
}

.logout-link:hover {
    color: #495057 !important;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .email-verification-card {
        padding: 30px 20px !important;
    }

    .verification-title {
        font-size: 20px !important;
    }

    .verification-icon i {
        font-size: 50px;
    }

    .btn-verification {
        padding: 12px 20px !important;
        font-size: 14px !important;
    }
}
</style>
@endsection
