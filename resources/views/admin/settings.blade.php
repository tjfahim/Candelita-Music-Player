@extends('admin.layouts.master')

@section('main_content')
<h2>Settings</h2>

<div class="row">

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
  <form method="post" class="col-md-12 row" action="{{ route('settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')  
    <input type="hidden" value="{{ $settings->id }}" name="id">
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Radio</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Radio Title</label>
          <input type="text" class="form-control" id="" name="radio" placeholder="Enter Radio Title" value="{{ $settings->radio }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Radio Link</label>
          <input type="text" class="form-control" id="" name="radio_link" value="{{ $settings->radio_link }}" placeholder="Enter Radio link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Radio Image</label>
        <div>
            {{ asset('image/' . $settings->radio_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="radio_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">TV EN Vivo</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">TV EN Vivo Title</label>
          <input type="text" class="form-control" id="" name="tv_en_vivo" placeholder="Enter TV EN Vivo Title" value="{{ $settings->tv_en_vivo }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">TV EN Vivo Link</label>
          <input type="text" class="form-control" id="" name="tv_en_vivo_link" value="{{ $settings->tv_en_vivo_link }}" placeholder="Enter TV EN Vivo Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">TV EN Vivo Image</label>
        <div>
          @php
              if ($settings->tv_en_vivo_image){
                asset('image/' . $settings->tv_en_vivo_image);
              }
             
          @endphp
        </div>
        
        <input type="file" class="form-control-file" id="image" name="tv_en_vivo_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Youtube</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Youtube Title</label>
          <input type="text" class="form-control" id="" name="youtube" placeholder="Enter Youtube Title" value="{{ $settings->youtube }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Youtube Link</label>
          <input type="text" class="form-control" id="" name="youtube_link" value="{{ $settings->youtube_link }}" placeholder="Enter Youtube Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Youtube Image</label>
                <div>
            {{ asset('image/' . $settings->youtube_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="youtube_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Youtube Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Facebook</h5>
      <div class="form-group col-md-12 my-2">
          <label for="">Facebook Title</label>
          <input type="text" class="form-control" id="" name="facebook" placeholder="Enter Facebook Title" value="{{ $settings->facebook }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Facebook Link</label>
          <input type="text" class="form-control" id="" name="facebook_link" value="{{ $settings->facebook_link }}" placeholder="Enter Facebook Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Facebook Image</label>
                <div>
            {{ asset('image/' . $settings->facebook_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="facebook_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Instagram</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Instagram Title</label>
          <input type="text" class="form-control" id="" name="instagram" placeholder="Enter Instagram Title" value="{{ $settings->instagram }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Instagram Link</label>
          <input type="text" class="form-control" id="" name="instagram_link" value="{{ $settings->instagram_link }}" placeholder="Enter Instagram Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Instagram Image</label>
                <div>
            {{ asset('image/' . $settings->instagram_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="instagram_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Instagram Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Books</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Books Title</label>
          <input type="text" class="form-control" id="" name="books" placeholder="Enter Books Title" value="{{ $settings->books }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Books Link</label>
          <input type="text" class="form-control" id="" name="books_link" value="{{ $settings->books_link }}" placeholder="Enter Books Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Books Image</label>
                <div>
            {{ asset('image/' . $settings->books_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="books_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Books Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Books Sharp</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Books Sharp Title</label>
          <input type="text" class="form-control" id="" name="books_sharp" placeholder="Enter Books Sharp Title" value="{{ $settings->books_sharp }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Books Sharp Link</label>
          <input type="text" class="form-control" id="" name="books_sharp_link" value="{{ $settings->books_sharp_link }}" placeholder="Enter Books Sharp Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Books Sharp Image</label>
                  <div>
            {{ asset('image/' . $settings->books_sharp_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="books_sharp_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Books Sharp Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Web</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Web Title</label>
          <input type="text" class="form-control" id="" name="web" placeholder="Enter Web Title" value="{{ $settings->web }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Web Link</label>
          <input type="text" class="form-control" id="" name="web_link" value="{{ $settings->web_link }}" placeholder="Enter Web Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Web Image</label>
                <div>
            {{ asset('image/' . $settings->web_image); }}
        </div>
        <input type="file" class="form-control-file" id="web_image" name="web_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Web Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Phone</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Phone Title</label>
          <input type="text" class="form-control" id="" name="phone" placeholder="Enter Phone Title" value="{{ $settings->phone }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Phone Link</label>
          <input type="text" class="form-control" id="" name="phone_link" value="{{ $settings->phone_link }}" placeholder="Enter Phone Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Phone Image</label>
                <div>
            {{ asset('image/' . $settings->phone_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="phone_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Phone Preview">
      </div>
    </div>
    <div class="col-md-5 card p-3 m-2">
      <h5 class="text-primary ">Donate</h5>
    
      <div class="form-group col-md-12 my-2">
          <label for="">Donate Title</label>
          <input type="text" class="form-control" id="" name="donate" placeholder="Enter Donate Title" value="{{ $settings->donate }}">

      </div>
      <div class="form-group col-md-12 my-2">
          <label for="">Donate Link</label>
          <input type="text" class="form-control" id="" name="donate_link" value="{{ $settings->donate_link }}" placeholder="Enter Donate Link">
      
      </div>
      <div class="form-group col-md-12 my-2">
        <label for="image">Donate Image</label>
                <div>
            {{ asset('image/' . $settings->donate_image); }}
        </div>
        <input type="file" class="form-control-file" id="image" name="donate_image" accept="image/*">
        <img class="img-fluid mt-2" style="display: none;" alt="Image Donate Preview">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2 mb-3 col-md-11">Update</button>
  </form>
</div>
   


  

@endsection
