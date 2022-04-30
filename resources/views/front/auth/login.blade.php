@extends('front.index')
<main id="main" >
    <div class="logbody">
        <div class="contentlog col-lg-4 col-xs-12">
            <div class="text">
               login
            </div>
            <form action="{{route('login')}}" method="post">
                @include('front.massages')
                @csrf
                <div class="field">
                    <input type="text" name="email" placeholder="email" value="{{old('email')}}" class="@error('email') is-invalid @enderror">
                    <span class="icofont-ui-email"></span>
                    <label for="">email</label>
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="password" class="@error('password') is-invalid @enderror">
                    <span class="icofont-lock"></span>
                    <label for="">password</label>
                </div>
                <div class="capcha py-3">
                    {!! htmlFormSnippet() !!}
                </div>
                <div class="forgot-pass">
                    <label for="" style="padding-right: 22px;">Remember me</label>
                    <input type="checkbox" class="form-check-input" name="remember">
                </div>

                <div class="forgot-pass">
                    <a href="{{route('password.request')}}">Forgot your password?</a>
                </div>
                <button type="submit" class="buttlog"> Login</button>
                <div class="sign-up">
                    Have not registered before?
                    <a href="{{route('register')}}">Register</a>
                </div>
            </form>
        </div>
    </div>
</main><!-- End #main -->
