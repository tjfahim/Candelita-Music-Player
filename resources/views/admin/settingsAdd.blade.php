@extends('admin.layouts.master')

@section('main_content')
<h4>Add Settings</h4>
<form method="post" action="{{ route('settings.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-md-12 my-2">
        <label for="">Title</label>
        <input type="text" class="form-control" id="" name="title" placeholder="Enter Title">
        @if ($errors->has('title'))
            <div >
                    @foreach ($errors->get('title') as $error)
                    <span class="text-danger " >{{ $error }}</span>
                    @endforeach
            </div>
        @endif
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="">Link</label>
        <input type="text" class="form-control" id="" name="link" placeholder="Enter Link">
            @if ($errors->has('link'))
            <div >
                    @foreach ($errors->get('link') as $error)
                        <span class="text-danger " >{{ $error }}</span>
                    @endforeach
            </div>
        @endif
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
        <img id="imagePreview" class="img-fluid mt-2" style="display: none;" alt="Image Preview">
            @if ($errors->has('image'))
            <div >
                    @foreach ($errors->get('image') as $error)
                    <span class="text-danger " >{{ $error }}</span>
                    @endforeach
            </div>
        @endif
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


  
<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
@endsection
