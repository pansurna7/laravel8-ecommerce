@extends('admin.master')
@section('title')
    User || Add
@endsection
@section('content')
    <div class="content-header mt-4 fixed">
        <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">User Generate</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class=" breadcrumb-item">
                            @if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['user']['view']))
                                <a href="{{route('all-user')}}" class="card-title">
                                    <i class="fas fa-list nav-icon"></i>
                                    User List
                                </a>
                            @else
                                <a href="" class="card-title disabled" aria-disabled="true">
                                    <i class="fas fa-list nav-icon"></i>
                                    user List
                                </a>
                            @endif
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
                                <h3 class="card-title">User</h3>
                            </div>
                                <div class="card-body">
                                    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="write User name">
                                                    @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"  value="{{old('email')}}" placeholder="write  email">
                                                    @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" class="form-control  @error('number') is-invalid @enderror" name="number" value="{{old('number')}}">
                                                    @error('number')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select name="role_id" class="form-control  @error('role_id') is-invalid @enderror">
                                                        <option value="">Please select role</option>
                                                        @foreach (\App\Models\Role::all() as $role )
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password">
                                                    @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control  @error('ConfirmPassword') is-invalid @enderror" name="ConfirmPassword">
                                                    @error('ConfirmPassword')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label for="file">Choose Image</label>
                                                    <input type="file" id="file" name="file" class="form-control" onchange="priviewFile(this)" />
                                                    <img id="priviewImg" alt="profile img" style="max-width: 130px;margin-top:20px" />
                                                </div>
                                            </div>  --}}
                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Save</button>
                                        </div>

                                    </form>
                                </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
