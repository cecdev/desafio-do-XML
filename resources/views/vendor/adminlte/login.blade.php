@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')

    <div class="col-md-7 col-lg-9 col-sm-7 hidden-xs screen-login-left">&nbsp;</div>
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
                <h1 class="title-page text-center"><strong>Desafio do XML!</strong></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="font-size: 1.8rem; padding-left: 7%; padding-right: 7%; justify-content: center;">
                   <p> Cliente precisa fazer download de muitos XML, porém quando esse volume é muito grande, ou seja, passa de 5 minutos processando os XMLs na pagina, ocorre Timeout. </p>
                    <p>
                            A arquitetura para download desses arquivos precisa rodar em background e o usuário seja notificado quando o download terminar, sem a necessidade de ficar aguardando, o processo concluir.
                    </p>
                </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="container-login">

                    <!-- /.login-logo -->
                    <div class="">
                        <p class="text-left" style="color: #757586;"><strong>Entrar na solução do desafio:</strong></p>
                        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
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
                            <div class="row">
                                <div class="col-xs-6">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{ trans('adminlte::adminlte.sign_in') }}</button>
                                </div>

                                    @if (config('adminlte.register_url', 'register'))
                                    <div class="col-xs-6">
                                <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                                   class="btn btn-primary btn-block btn-lg text-center"
                                >Cadastrar</a>
                            </div>
                            @endif

                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-6">
                                    <div class="auth-links">
                                        <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                                           class="text-center"
                                        ><strong>{{ trans('adminlte::adminlte.i_forgot_my_password') }}</strong></a>
                                    </div>
                                </div>

                                <!-- /.col -->
                            </div>
                        </form>

                    </div>
                    <!-- /.login-box-body -->
                </div><!-- /.login-box -->
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
