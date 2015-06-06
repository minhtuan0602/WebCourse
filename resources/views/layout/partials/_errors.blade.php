<div class="container">
  @if (Session::has('message'))
    <div class="alert alert-success">
      <p>{{ Session::get('message') }}</p>
    </div>
  @endif
  
  @if ($errors->any())
    <div class='alert alert-danger'>
      @foreach ( $errors->all() as $error )
        <p>{{ $error }}</p>
      @endforeach
    </div>
  @endif
</div>