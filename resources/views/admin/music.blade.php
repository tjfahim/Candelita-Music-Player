@extends('admin.layouts.master')

@section('main_content')
<h3>All Music</h3>
<a href="{{ route('music.create')}}" class="btn btn-primary">Add Music</a>

@if(session('success'))
    <div class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger my-3">
        {{ session('error') }}
    </div>
@endif
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Artist</th>
      <th scope="col">Image</th>
      <th scope="col">Song file</th>
      <th scope="col">Listening</th>
      <th scope="col">Android</th>
      <th scope="col">Ios</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($livePlayerManageRecords as $music)
    <tr>
      <th scope="row">{{ $music->id }}</th>
      <td>{{ $music->title }}</td>
      <td>{{ $music->artist }}</td>
      <td><img src="{{ asset('image/' . $music->image) }}" alt="Music Image" style="width: 50px; height: 50px;"></td>

      <!-- Creating a download link for the song file -->
      <td>
          <a href="{{ asset('song_file/' . $music->song_file) }}" download="{{ $music->song_file }}">
              {{ $music->song_file }}
          </a>
      </td>
      <td>{{ $music->listening }}</td>
      <td>{{ $music->android }}</td>
      <td>{{ $music->ios }}</td>
      <td>
        <!-- Edit Icon -->
        <a href="{{ route('music.edit', $music->id) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-edit">Edit</i> 
        </a>

        <!-- Delete Icon -->
        <form action="{{ route('music.destroy', $music->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('POST')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this music?')">
                <i class="fa fa-trash">Delete</i>
            </button>
        </form>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
{{ $livePlayerManageRecords->links('pagination::bootstrap-4') }}

@endsection
