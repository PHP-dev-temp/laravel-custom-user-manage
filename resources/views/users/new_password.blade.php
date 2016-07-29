@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset password</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ route('new.password') }}" method="POST">

                            <div class="form-group">
                                <label for="pwd" class="col-md-4 control-label">New password:</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" id="pwd">
                                </div>
                            </div>

                            <input type="hidden" name="identifier" value="{{ $code }}">

                            <input type="hidden" name="email" value="{{ $email }}">

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Save password
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