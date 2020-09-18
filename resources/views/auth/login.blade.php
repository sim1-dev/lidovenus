@extends('layouts.app')

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="container-fluid p-3">
                    <div class="container p-3" style="min-height:420px;background: url('img/3263.jpg');background-repeat: no-repeat;background-size:cover;"></div>
                </div>
                <span class="login100-form-title p-b-34">
                    Accedi
                </span>

                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Inserisci email">
                    <input placeholder="E-mail" id="email" type="email" class="form-control @error('email') is-invalid @enderror input100" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="focus-input100"></span>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Inserisci password">
                    <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror input100" name="password" required autocomplete="current-password">
                    @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('img/palms.jpg');"></div>
        </div>
    </div>
</div>
@endsection
