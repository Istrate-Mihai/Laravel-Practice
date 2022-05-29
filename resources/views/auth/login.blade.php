@extends('layouts.app')
@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email" name="email" value="{{ old('email') }}" type="email" required
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" />

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" />

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                    value="{{ old('remember') ? 'checked' : '' }}" />

                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary value=" Login" />
        </div>
    </form>
@endsection
