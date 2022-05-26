@extends('layouts.app')
@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" type="text" required
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" />

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

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
            <label for="password_confirmation">Retyped Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" />
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" />
        </div>
    </form>
@endsection
