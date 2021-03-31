@extends('admin.master')
@section('title')
    Catergory || Add
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Category Generate</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class=" breadcrumb-item">
                            <a href="{{route('category.manage')}}">
                                <i class="fas fa-list nav-icon"></i>
                                Category List
                            </a>
                         </li>
                     </ol>
                 </div>
             </div>
        </div>

    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{route('category.store')}}" method="post" class="form-inline">
                                    @csrf
                                    <label  class="mb-2 mr-sm-2">Name</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 @error('name') is-invalid @enderror" name="name" placeholder="write category name">
                                    @error('name')
                                    <div class="alert alert-danger mb-2 mr-sm-2">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-info mb-2">Submit</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
