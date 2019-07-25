@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
<div class="col-md-7 col-lg-9 col-sm-7 hidden-xs screen-login-left">A</div>
<div class="col-md-5 col-lg-3 col-sm-5 col-xs-12 screen-login-rigth">
    <div class="row">
        <div class="col-sm-12 bg-primary">
            &nbsp;
        </div>
    </div>
    <div class="row hidden-sm hidden-md hidden-lg">

            <div class="col-sm-12 image-desafio"  >

            </div>
        </div>
    <div class="row">

        <div class="col-sm-12">
            <h1 class="title-page text-center"><strong>Diversão sem limites!</strong></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="container-login">

                    <div class="container-login">

                            <p class="text-left" style="color: #757586;"><strong>{{ trans('adminlte::adminlte.register_message') }}</strong></p>
                            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                                {!! csrf_field() !!}


                                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input type="email" name="email" class="form-control input-login" value="{{ old('email') }}"
                                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <input type="password" name="password" class="form-control input-login"
                                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <input type="password" name="password_confirmation" class="form-control input-login"
                                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit"
                                        class="btn btn-primary btn-block btn-lg"
                                >{{ trans('adminlte::adminlte.register') }}</button>
                            </form>
                            <div class="auth-links">
                                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
                            </div>
                        </div>

            </div><!-- /.login-box -->
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
    @yield('js')
@stop
