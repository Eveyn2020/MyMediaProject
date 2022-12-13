@extends("admin.layouts.app")

@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
          <form action="{{route('admin#categoryCreate')}}" method="post">
            @csrf
            <div class="form-grup">
                <label for="">Category Name</label>
                <input type="text" name="categoryName" class="form-control" placeholder="Enter Category Name..">
                @error('categoryName')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
               <textarea class="form-control" name="categoryDescription" cols="30" rows="7" placeholder="Enter Description.."></textarea>
               @error('categoryDescription')
               <div class="text-danger">{{ $message }}</div>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
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
        <h3 class="card-title">Category List Table</h3>

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
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($categories as $category )
           <tr>
            <td>{{$category['category_id']}}</td>
            <td>{{$category['title']}}</td>
            <td>{{$category['description']}}</td>
            <td>
            <a href="{{route('admin#editCategory',$category['category_id'])}}">
                <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
            </a>

              <a href="{{route('admin#deleteCategory',$category['category_id'])}}">
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
