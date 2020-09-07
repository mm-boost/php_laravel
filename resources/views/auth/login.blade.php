@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-box card">
                    <div class="login-header card-header mx-auto">{{ __('messages.Login') }}</div> <!-- ヘルパ関数　＿＿（）翻訳文字列取得 -->

                    <div class="login-body card-body">
                        <form method="POST" action="{{ route('login') }}">  <!-- route関数 URLを生成、リダイレクト。今回は”/login”URLを生成　-->
                            @csrf  <!-- 認証済みのユーザーがリクエストを送信しているのかを確認するために利用 -->

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email')) <!--三項演算子 -->
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password')) <!--三項演算子 -->
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.Remember Me') }}
                                                                                   <!-- oldヘルパ関数 
                                                        セッションにフラッシュデータ（一時的にしか保存されないデータ）として入力されているデータを取得することができます。
                                                        今回のフラッシュデータは、直前までユーザーが入力していた値のことを指します。直前のデータがない場合は、nullを返します。-->                                       </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('messages.Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection