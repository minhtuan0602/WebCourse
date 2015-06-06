<div class="form-group">
  {!! Form::label('username', 'Username: ') !!}
  {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('password', 'Mật khẩu: ') !!}
  {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('password_confirmation', 'Xác nhận mật khẩu: ') !!}
  {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('email', 'Email: ') !!}
  {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('type', 'Cấp quyền:', array('class' => 'input-label')) !!}
  {!! Form::select('type', array('A' => 'Admin', 'G' => 'Teacher')) !!}
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>