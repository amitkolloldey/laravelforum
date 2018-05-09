<h2>{{__('Register')}}</h2>

@if (session('confirmation-success'))
    <div class="alert alert-success">
        {{ session('confirmation-success') }}
    </div>
@else
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-3 control-label">{{__('Name')}}</label>
            <div class="col-md-9">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-3 control-label">{{__('E-Mail Address')}}</label>
            <div class="col-md-9">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                <span>{{__('This email will fetch Gravater image to your profile if have one.')}}</span>
                @if ($errors->has('email'))
                    <span class="help-block">
                       <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-3 control-label">{{__('Password')}}</label>

            <div class="col-md-9">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                @endif
            </div>
        </div>

        <div class=" row form-group">
            <label for="password-confirm" class="col-md-3 control-label">{{__('Confirm Password')}}</label>

            <div class="col-md-9">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="row form-group text-center">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    {{__('Register')}}
                </button>
            </div>
        </div>
    </form>
@endif