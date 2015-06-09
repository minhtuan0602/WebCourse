<div class="form-group">
  {!! Form::label('title', 'Tiêu đề: ') !!}
  {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nhập tiêu đề']) !!}
</div>


<div class="form-group">
  {!! Form::label('description', 'Mô tả ngắn: ') !!}
  {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Nhập mô tả ngắn']) !!}
</div>


<div class="form-group">
  {!! Form::label('content', 'Nội dung: ') !!}
  {!! Form::textarea('content', null, ['class' => 'textarea', 'id' => 'content', 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) !!}
</div>

<div class="form-group">
  {!! Form::label('type', 'Thể loại:') !!}
  {!! Form::select('type', [1 => 'Lĩnh vực nghiên cứu', 2 => 'Bài báo khoa học'] , null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('tags', 'Tags (ngăn nhau bằng -): ') !!}
  {!! Form::text('tags', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('position', 'Position: ') !!}
  {!! Form::input('number', 'position', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('image', 'Chọn hình: ', array('class' => 'input-label')) !!}
  {!! Form::file('image') !!}
</div>

<div class="form-group">
  <input type='submit' value="{{ $submit_text }}" onclick="nicEditors.findEditor('content').saveContent();">
</div>
