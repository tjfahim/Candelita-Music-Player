@extends('admin.layouts.master')

@section('main_content')
<h4>Edit Settings</h4>
    <form method="post" action="{{ route('settings.update', ['id' => $settings->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group col-md-12 my-2">
        <label for="">Title</label>
        <input type="text" class="form-control" id="" name="title" placeholder="Enter Title" value="{{ $settings->title }}">
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
        <input type="text" class="form-control" id="" name="link" value="{{ $settings->link }}" placeholder="Enter Link">
            @if ($errors->has('link'))
            <div >
                    @foreach ($errors->get('link') as $error)
                        <span class="text-danger " >{{ $error }}</span>
                    @endforeach
            </div>
        @endif
      </div>
    <!-- Image Input -->
<div class="form-group col-md-12 my-2">
    <label for="image">Image</label>
    <input type="file" class="form-control-file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
    <img id="imagePreview" class="img-fluid mt-2" style="display: none;" alt="Image Preview">

    @if ($errors->has('image'))
        <div>
            @foreach ($errors->get('image') as $error)
                <span class="text-danger">{{ $error }}</span>
            @endforeach
        </div>
    @endif

    <!-- Display the current image if it exists -->
    @if ($settings && $settings->image)
        <div class="mt-2">
            <label>Current Image:</label>
            <img src="{{ asset('image/' . $settings->image) }}" alt="Current Settings Image" style="width: 50px; height: 50px;">
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
