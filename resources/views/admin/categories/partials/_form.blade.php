<div class="form-group">
  {!! Form::label('name', 'Tên: ') !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nhập tên']) !!}
</div>

<div class="form-group">
  {!! Form::label('slug', 'Slug: ') !!}
  {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('position', 'Position: ') !!}
  {!! Form::input('number', 'position', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  <input type='submit' value="{{ $submit_text }}" onclick="nicEditors.findEditor('content').saveContent();">
</div>