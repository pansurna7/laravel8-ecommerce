@extends('admin.master')
@section('title')
    Parmission-Add
@endsection
@section('content')
    <form action="{{ route('parmission.store') }}" method="post">
        @csrf
        <div class="card p-5">
            <h3 class="card-header-tabs">
                <a href="{{ route('parmission.index') }}" class="btn btn-sm text-muted float-right">
                    <i class="fa fa-list-alt nav-icon"></i> Go Back
                </a>
                Parmission Add
            </h3><hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                        <h3>Main Menu</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Main Menu</th>
                                    <th scope="col">Acccess</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <th scope="row">{{$menu->menu}}

                                        </th>
                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input" id="{{$menu->id}}" name="parmission[{{$menu->menu}}]" value="1">
                                                <label class="custom-control-label" for="{{$menu->id}}"></label>
                                            </div></div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                        <select name="role_id" class="form-control">
                            <option value="">Please select a role</option>
                            @foreach(\App\Models\Role::all() as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Access</th>
                                    <th scope="col">Add</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Delete</th>
                                    <th scope="col">List</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sbmenus as $sb)
                                    <tr>
                                        <th scope="row">{{$sb->title}}</th>
                                        <td><input type="checkbox" name="parmission[{{$sb->title}}][add]" value="1"></td>
                                        <td><input type="checkbox" name="parmission[{{$sb->title}}][edit]" value="1"></td>
                                        <td><input type="checkbox" name="parmission[{{$sb->title}}][view]" value="1"></td>
                                        <td><input type="checkbox" name="parmission[{{$sb->title}}][delete]" value="1"></td>
                                        <td><input type="checkbox" name="parmission[{{$sb->title}}][list]" value="1"></td>

                                    </tr>
                                @endforeach

                                {{--  <tr>
                                    <th scope="row">Parmission</th>
                                    <td><input type="checkbox" name="parmission[parmission][add]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[parmission][edit]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[parmission][view]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[parmission][delete]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[parmission][list]" value="1"></td>

                                </tr>
                                <tr>
                                    <th scope="row">User</th>
                                    <td><input type="checkbox" name="parmission[user][add]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[user][edit]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[user][view]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[user][delete]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[user][list]" value="1"></td>

                                </tr>
                                <tr>
                                    <th scope="row">Menu</th>
                                    <td><input type="checkbox" name="parmission[menu][add]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[menu][edit]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[menu][view]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[menu][delete]" value="1"></td>
                                    <td><input type="checkbox" name="parmission[menu][list]" value="1"></td>

                                </tr>  --}}
                                <tr>
                                    @error('parmission')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="submit" class="btn btn-outline-primary" value="Submit">
            </div>
        </div>


    </form>
@endsection
