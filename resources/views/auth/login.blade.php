<form method="POST" action="/auth/login">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

    <div>
        Username
        {!! Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'username', 'autofocus' => 'autofocus')) !!}
        {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>
<div>
    @if(Session::get('failed') != '')
        <div class="text-danger login-error">{{ Session::get("failed") }}</div>
    @endif
</div>
    <div>
        <button type="submit">Login</button>
    </div>
</form>