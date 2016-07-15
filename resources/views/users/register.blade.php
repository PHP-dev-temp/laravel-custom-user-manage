@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Registration form</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ route('register.user') }}" method="POST">
                            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Username:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                                    @if ($errors->has('username'))<span class="help-block">{{ $errors->first('username') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email address:</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))<span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="pwd" class="col-md-4 control-label">Password:</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" id="pwd">
                                    @if ($errors->has('password'))<span class="help-block">{{ $errors->first('password') }}</span> @endif
                                </div>
                            </div>

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection