@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit user</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ route('user.edit') }}" method="POST">
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                    @if ($errors->has('name'))<span class="help-block">{{ $errors->first('name') }}</span> @endif
                                </div>
                            </div>

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Save
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