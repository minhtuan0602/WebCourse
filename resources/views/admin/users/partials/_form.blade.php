<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('username', 'Username: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::text('username') !!}
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('password', 'Mật khẩu: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::password('password') !!}
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('password_confirmation', 'Xác nhận mật khẩu: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::password('password_confirmation') !!}
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('email', 'Email: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::text('email') !!}
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('type', 'Trạng thái:', array('class' => 'input-label')) !!}
  </div>
  <div class="col-xs-6">
    {!! Form::select('type', array('A' => 'Admin', 'G' => 'Teacher')) !!}
  </div>
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>