@extends('admin.master')
@section('title')
    Parmission-Edit
@endsection
@section('content')
    <form action="{{ route('parmission.update',$parmission->id) }}" method="post">
        @csrf
        <div class="card p-5">
            <h3 class="card-header-tabs">
                <a href="{{ route('parmission.index') }}" class="btn btn-sm text-muted float-right">
                    <i class="fa fa-list-alt nav-icon"></i> Go Back
                </a>
                Parmission Edit
            </h3><hr>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                        <select name="role_id" class="form-control">
                            <option value="">Please select a role</option>
                            @foreach(\App\Models\Role::all() as $role)
                                <option value="{{$role->id}}" @if($role->id == $parmission->role_id) selected @endif>{{$role->name}}</option>
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
                                <tr>
                                    <th scope="row">Role</th>
                                    <td><input type="checkbox" name="parmission[role][add]"
                                        value="1" @isset($parmission['parmission']['role']['add']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[role][edit]"
                                        value="1" @isset($parmission['parmission']['role']['edit']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[role][view]"
                                        value="1" @isset($parmission['parmission']['role']['view']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[role][delete]"
                                        value="1" @isset($parmission['parmission']['role']['delete']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[role][list]"
                                        value="1" @isset($parmission['parmission']['role']['list']) checked @endisset>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Parmission</th>
                                    <td><input type="checkbox" name="parmission[parmission][add]"
                                        value="1" @isset($parmission['parmission']['parmission']['add']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[parmission][edit]"
                                        value="1" @isset($parmission['parmission']['parmission']['edit']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[parmission][view]"
                                        value="1" @isset($parmission['parmission']['parmission']['view']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[parmission][delete]"
                                        value="1" @isset($parmission['parmission']['parmission']['delete']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[parmission][list]"
                                        value="1" @isset($parmission['parmission']['parmission']['list']) checked @endisset>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">User</th>
                                    <td><input type="checkbox" name="parmission[user][add]"
                                        value="1" @isset($parmission['parmission']['user']['add']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[user][edit]"
                                        value="1" @isset($parmission['parmission']['user']['edit']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[user][view]"
                                        value="1" @isset($parmission['parmission']['user']['view']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[user][delete]"
                                        value="1" @isset($parmission['parmission']['user']['delete']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[user][list]"
                                        value="1" @isset($parmission['parmission']['user']['list']) checked @endisset>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Menu</th>
                                    <td><input type="checkbox" name="parmission[menu][add]"
                                        value="1" @isset($parmission['parmission']['menu']['add']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[menu][edit]"
                                        value="1" @isset($parmission['parmission']['menu']['edit']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[menu][view]"
                                        value="1" @isset($parmission['parmission']['menu']['view']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[menu][delete]"
                                        value="1" @isset($parmission['parmission']['menu']['delete']) checked @endisset>
                                    </td>
                                    <td><input type="checkbox" name="parmission[menu][list]"
                                        value="1" @isset($parmission['parmission']['menu']['list']) checked @endisset>
                                    </td>
                                </tr>
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
