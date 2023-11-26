@extends('admin.layouts.master')

@section('main_content')
<h3>Settings</h3>
<a href="{{ route('settings.create')}}" class="btn btn-primary">Add</a>

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
      <th scope="col">Link</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($settings as $setting)
    <tr>
      <th scope="row">{{ $setting->id }}</th>
      <td>{{ $setting->title }}</td>
      <td>{{ $setting->link }}</td>
      <td><img src="{{ asset('image/' . $setting->image) }}" alt="Setting Image" style="width: 50px; height: 50px;"></td>    
      <td>
        <!-- Edit Icon -->
        <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-edit">Edit</i> 
        </a>

        <!-- Delete Icon -->
        <form action="{{ route('settings.destroy', $setting->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('POST')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this settings?')">
                <i class="fa fa-trash">Delete</i>
            </button>
        </form>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
{{ $settings->links('pagination::bootstrap-4') }}

@endsection
