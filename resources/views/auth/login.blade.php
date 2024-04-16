@extends('layouts.app')

@section('content')
    <section class="form-02-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="_lk_de">
                        <div class="form-03-main">
                            <div class="logo">
                                <img src="assets/images/user.png">
                            </div>

                            <form method="POST" action="{{ route('login') }}" class="login">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control _ge_de_ol @error('email') is-invalid @enderror" type="text"
                                        placeholder="Enter Email">
                                    @error('email')
                                        <div class="invalid-feedback error-message" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control _ge_de_ol @error('password') is-invalid @enderror"
                                        type="text" placeholder="Enter Password">
                                    @error('password')
                                        <div class="invalid-feedback error-message" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="checkbox form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label" for="">Remember me</label>
                                    </div>
                                    <a href="{{ route('forget.password') }}">Forgot Password</a>
                                </div>
                                <button type="submit" class="button _btn_04">
                                    <span class="button__text">Log In Now</span>
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
