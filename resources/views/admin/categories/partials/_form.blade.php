<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('name', 'Tên: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::text('name') !!}
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('slug', 'Slug: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::text('slug') !!}
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('position', 'Vị trí: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::text('position') !!}
  </div>
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>