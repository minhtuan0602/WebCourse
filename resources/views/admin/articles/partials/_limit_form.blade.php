<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('title', 'Tiêu đề: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::text('title') !!}
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('content', 'Nội dung: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::textarea('content') !!}
  </div>
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>