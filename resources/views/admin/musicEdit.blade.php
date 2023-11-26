@extends('admin.layouts.master')

@section('main_content')
<h4>Edit Music</h4>
    <form method="post" action="{{ route('music.update', ['id' => $music->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group col-md-12 my-2">
        <label for="">Title</label>
        <input type="text" class="form-control" id="" name="title" placeholder="Enter Title" value="{{ $music->title }}">
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
        <input type="text" class="form-control" id="" name="artist" value="{{ $music->artist }}" placeholder="Enter Artist">
            @if ($errors->has('artist'))
            <div >
                    @foreach ($errors->get('artist') as $error)
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
    @if ($music && $music->image)
        <div class="mt-2">
            <label>Current Image:</label>
            <img src="{{ asset('image/' . $music->image) }}" alt="Current Music Image" style="width: 50px; height: 50px;">
        </div>
    @endif
</div>

<!-- Song File Input -->
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

    <!-- Display the current song file if it exists -->
    @if ($music && $music->song_file)
        <div class="mt-2">
            <label>Current Song File:</label>
            <a href="{{ asset('song_file/' . $music->song_file) }}" download="{{ $music->song_file }}">
                {{ $music->song_file }}
            </a>
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
