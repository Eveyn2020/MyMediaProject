@extends("admin.layouts.app")

@section('content')
<div class="col-12">
    <div class=" offset-9 col-3">
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
        <h3 class="card-title">Admin List Table</h3>

        <div class="card-tools">
         <form action="{{route('admin#ListSearch')}}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminSearchKey" class="form-control float-right" value="{{old('adminSearchKey')}}" placeholder="Search">

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
              <th>User ID</th>
              <th> Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Address</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($userData as $user )
           <tr>
        <td>{{$user['id']}}</td>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['phone']}}</td>
            <td>{{$user['gender']}}</td>
            <td>{{$user['address']}}</td>
            <td>
              @if($currentUser != $user['id'])
                {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
               <a href="{{route('admin#Accdelete',$user['id'])}}"> <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
              @endif
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
