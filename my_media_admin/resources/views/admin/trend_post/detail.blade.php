@extends("admin.layouts.app")

@section('content')
<div class="col-6 offset-3 mt-5">
    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
    <div class="card-header">
    <img @if ($post['image'] != null)
                src="{{asset('postImage/'.$post['image'])}}"

            @else
            src="{{asset('defaultPIC/defaultPIC.png')}}"
            @endif
            alt="" class="rounded shadow-sm col-12">
     </div>
     <div class="card-body">
        <h3 class="text-center">{{$post['title']}}</h3>
        <p class="text-start">{{$post['description']}}</p>
     </div>
    </div>
    <!-- /.card -->
    
</div>

@endsection
