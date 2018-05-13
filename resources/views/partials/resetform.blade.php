<h2 >{{__('Reset Password')}}</h2>
<form method="POST" action="{{ route('password.request') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group row">
        <label for="email" class="col-md-3 col-form-label">{{ __('E-Mail Address') }}</label>

        <div class="col-md-9">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-9">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password')}}</label>

        <div class="col-md-9">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="row form-group text-center">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                {{ __('Reset Password') }}
            </button>
        </div>
    </div>
</form>