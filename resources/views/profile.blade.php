@extends('admin.master')
@section('title')
    User Profile
@endsection
@section('content')
    <div class="content-header mt-4 fixed">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                          <a href="{{route('profile.index')}}" class="card-title">User Profile</a>
                        </li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="main-body">
                  <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{asset('Source/back/dist/img/profile')}}/{{Auth::guard('admin')->user()->image}}" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                              <h4>{{strtoupper(Auth::guard('admin')->user()->name)}}</h4>
                              <p class="text-secondary mb-1">{{strtoupper(Auth::guard('admin')->user()->divisi)}}</p>
                              <p class="text-muted font-size-sm">{{strtoupper(Auth::guard('admin')->user()->address)}}</p>
                              <button  class="btn btn-outline-primary" data-toggle="modal" data-target="#UserUpdate{{Auth::guard('admin')->user()->id}}" title="Edit">
                                <i class="fas fa-edit nav-icon"></i> Edit Profile
                              </button>
                              {{-- <button class="btn btn-outline-primary" id="btnEdit"><i class="fas fa-edit nav-icon"></i>Edit Profile</button> --}}
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                            <span class="text-secondary">https://bootdey.com</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                            <span class="text-secondary">bootdey</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                            <span class="text-secondary">@bootdey</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                            <span class="text-secondary">bootdey</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                            <span class="text-secondary">bootdey</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="card mb-3">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{strtoupper(Auth::guard('admin')->user()->fullname)}}
                            </div>
                          </div>
                          <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{Auth::guard('admin')->user()->email}}
                                </div>
                            </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Mobile</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{Auth::guard('admin')->user()->number}}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{strtoupper(Auth::guard('admin')->user()->address)}}
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="UserUpdate{{Auth::guard('admin')->user()->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content">
          <div class="modal-header bg-primary justify-content-center">
            <h5 class="modal-title" id="staticBackdropLabel">Update Profile</h5>

          </div>
          <div class="modal-body">
            <form action={{route('profile.update',Auth::guard('admin')->user()->id)}} method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{strtoupper(Auth::guard('admin')->user()->name)}}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{strtoupper(Auth::guard('admin')->user()->fullname)}}">
                    @error('fullname')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::guard('admin')->user()->email}}" readonly=true>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="number">Phone Number</label>
                    <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{Auth::guard('admin')->user()->number}}">
                    @error('number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{strtoupper(Auth::guard('admin')->user()->address)}}">
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="divisi">Division</label>
                    <input type="text" class="form-control @error('divisi') is-invalid @enderror" name="divisi" value="{{strtoupper(Auth::guard('admin')->user()->divisi)}}">
                    @error('divisi')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="ConfirmPassword">Confirm ConfirmPassword</label>
                    <input type="password" class="form-control @error('ConfirmPassword') is-invalid @enderror" name="ConfirmPassword">
                    @error('ConfirmPassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-md-2">
                  </div>

                  <div class="form-group col-md-8">
                    <input type="file" class="custom-file-input" onchange="priviewFile(this)" id="file" name="file">
		                <label class="custom-file-label" for="contohupload2">{{Auth::guard('admin')->user()->image}}</label>
                    <img src="{{asset('Source/back/dist/img/profile')}}/{{Auth::guard('admin')->user()->image}}" id="priviewImg" alt="profile img" style="max-width: 130px;margin-top:20px"/>
                  </div>
                  <div class="form-group col-md-2">
                  </div>


                <div class="modal-footer col-md-12 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>


@endsection
