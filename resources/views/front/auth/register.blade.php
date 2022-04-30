@extends('front.index')
<main id="main">
    <div class="logbody">
        <div class="contentlog col-lg-4 col-xs-12">
            <div class="text">
                Register
            </div>
            <form action="{{route('register')}}" method="post">
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
                <div class="field">
                    <input type="password" name="password_confirmation" placeholder="password confirmation" class="@error('password_confirmation') is-invalid @enderror">
                    <span class="icofont-lock"></span>
                    <label for="">password confirmation</label>
                </div>
                <div class="capcha py-3">
                    {!! htmlFormSnippet() !!}
                </div>
                <button type="submit" class="buttlog">Register</button>
                <div class="sign-up">
                    Have you registered before?
                    <a href="{{route('login')}}">Login</a>
                </div>
    </form>
        </div>
    </div>
</main><!-- End #main -->
