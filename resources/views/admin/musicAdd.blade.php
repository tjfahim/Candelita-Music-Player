@extends('admin.layouts.master')

@section('main_content')
<h4>Add Music</h4>
<form method="post" action="{{ route('music.store') }}" enctype="multipart/form-data">
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
        <label for="">Artist</label>
        <input type="text" class="form-control" id="" name="artist" placeholder="Enter Artist">
            @if ($errors->has('artist'))
            <div >
                    @foreach ($errors->get('artist') as $error)
                        <span class="text-danger " >{{ $error }}</span>
                    @endforeach
            </div>
        @endif
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="song_file_link">Music File Link</label>
        <input type="text" class="form-control" id="song_file_link" name="song_file_link" placeholder="Enter Link">
        @if ($errors->has('song_file_link'))
            <div>
                @foreach ($errors->get('song_file_link') as $error)
                    <span class="text-danger">{{ $error }}</span>
                @endforeach
            </div>
        @endif
    </div>
    
    <div class="form-group col-md-12 my-2">
        <label for="song_file">Music File</label>
        <input type="file" class="form-control-file" id="song_file" name="song_file" accept=".mp3">
        @if ($errors->has('song_file'))
            <div>
                @foreach ($errors->get('song_file') as $error)
                    <span class="text-danger">{{ $error }}</span>
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



<script>
    $(document).ready(function() {
        // Listen for changes in the file input
        $('#song_file').change(function() {
            // Disable the text input when a file is selected
            if ($(this).get(0).files.length > 0) {
                $('#song_file_link').prop('disabled', true);
            } else {
                $('#song_file_link').prop('disabled', false);
            }
        });

        // Listen for changes in the text input
        $('#song_file_link').on('input', function() {
            // Disable the file input when text is entered
            if ($(this).val().trim() !== '') {
                $('#song_file').prop('disabled', true);
            } else {
                $('#song_file').prop('disabled', false);
            }
        });
    });
</script>
@endsection
