@extends("admin.layouts.app")

@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
          <form action="{{route('admin#updatePost',$postDetail['post_id'])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="postTitle" class="form-control" value="{{old('postTitle',$postDetail->title)}}" placeholder="Enter Post Title..">
                @error('postTitle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
               <textarea class="form-control" name="postDescription" cols="30" rows="7" placeholder="Enter Description..">{{old('postDescription',$postDetail->description)}}</textarea>
               @error('postDescription')
               <div class="text-danger">{{ $message }}</div>
               @enderror
            </div>
            <div class="form-group">
                <label for="">Image</label><br>
                <img @if ($postDetail['image'] != null)
                src="{{asset('postImage/'.$postDetail['image'])}}"

            @else
            src="{{asset('defaultPIC/defaultPIC.png')}}"
            @endif
            alt="" class="rounded shadow-sm" style="width: 150px;"></td>
            <input type="file" name="postImage" class="form-control" placeholder="Enter Post Image..">
            </div>
            <div class="form-group">
                <label for="">Category Name</label>
                 <select name="postCategory" id="" class="form-control">
                    <option value="">Choose Category</option>
                    @foreach ($categories as $category )
                    <option value="{{$category['category_id']}}" 
                    @if ($category['category_id']== $postDetail['category_id']) selected @endif
                    >{{$category['title']}}</option>
                    @endforeach
                 </select>
                @error('postCategory')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>

        </div>
    </div>
</div>
<div class="col-8">
    <div class="col-4 offset-8">
        {{-- alert start --}}
        @if(Session::has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{Session::get('deleteSuccess')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        {{-- alert end --}}
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Post List Table</h3>

        <div class="card-tools">
         <form action="{{route('admin#searchCategory')}}" method="post">
            @csrf
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="searchCategory" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>

          </div>
        </form>

        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Title</th>
              <th>Image</th>

              <th></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($posts as $post )
           <tr>
            <td>{{$post['post_id']}}</td>
            <td>{{$post['title']}}</td>
            <td><img @if ($post['image'] != null)
                src="{{asset('postImage/'.$post['image'])}}"

            @else
            src="{{asset('defaultPIC/defaultPIC.png')}}"
            @endif
            alt="" class="rounded shadow-sm" style="width: 100px;"></td>

            <td>
            <a href="{{route('admin#updatePage',$post['post_id'])}}">
                <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
            </a>

              <a href="{{route('admin#deletlePost',$post['post_id'])}}">
                <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
              </a>
            </td>
          </tr>
           @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
