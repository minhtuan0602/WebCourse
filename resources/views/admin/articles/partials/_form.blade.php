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
    {!! Form::label('description', 'Mô tả ngắn: ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::textarea('description') !!}
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

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('tags', 'Tags (ngăn bằng dấu -): ') !!}
  </div>
  <div class="col-xs-6">
    {!! Form::text('tags') !!}
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

<div class="form-group row">
  <div class="col-xs-6">
    {!! Form::label('image', 'Chọn hình ảnh:', array('class' => 'input-label')) !!}
  </div>
  <div class="col-xs-6">
    {!! Form::file('image') !!}
  </div>
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>