@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Login form</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ route('login.check') }}" method="POST">
                            @if (Session::has('login_error'))
                                <div class="form-group">
                                    <span class="modal-header col-md-8 col-md-offset-2 bg-danger text-center">
                                        {{ Session::get('login_error') }}
                                    </span>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="credentials" class="col-md-4 control-label">Username/email:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="credentials" name="credentials">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pwd" class="col-md-4 control-label">Password:</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" id="pwd">
                                </div>
                            </div>

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                    </button>

                                    <a class="btn btn-link" href="{{ route('reset.password') }}">Forgot Your Password?</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection