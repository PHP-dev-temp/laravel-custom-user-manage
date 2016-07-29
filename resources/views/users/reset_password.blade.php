@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset password</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ route('reset.password') }}" method="POST">
                            @if (isset($email_error))
                                <div class="form-group">
                                    <span class="modal-header col-md-8 col-md-offset-2 bg-danger text-center">
                                        {{ $email_error }}
                                    </span>
                                </div>
                            @endif

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email address:</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))<span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                            </div>

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-link"></i> Send Password Reset Link
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