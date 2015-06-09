<div class="form-group">
  {!! Form::label('title', 'Tiêu đề: ') !!}
  {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nhập tiêu đề']) !!}
</div>

<div class="form-group">
  {!! Form::label('content', 'Nội dung: ') !!}
  {!! Form::textarea('content', null, ['class' => 'textarea', 'id' => 'content', 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) !!}
</div>

<div class="form-group">
  <input type='submit' value="{{ $submit_text }}" onclick="nicEditors.findEditor('content').saveContent();">
</div>