@extends('layouts.app', ['page' => __('All Users'), 'pageSlug' => 'users'])

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Users</h4>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('user.create')}}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add user</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @include('alerts.success')

                        <div class="">
                            <table class="table table-striped">
                                <thead class=" text-primary">
                                <tr><th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Professorship</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Creation Date</th>
                                    <th scope="col"></th>
                                </tr></thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                        </td>
                                        <td>{{$user->professorship->name ?? 'Not defined'}}</td>
                                        <td>
                                            @if($user->is_active == 1)
                                                <form action="{{route('user.update', $user->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="is_active" value="0">
                                                    <input type="submit" value="On" class="btn-sm btn-default">
                                                </form>
                                            @else
                                                <form action="{{route('user.update', $user->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="is_active" value="1">
                                                    <input type="submit" value="off" class="btn-sm btn-danger">
                                                </form>
                                            @endif
                                        </td>
                                        <td>{{$user->role->name ?? 'Not defined'}}</td>
                                        <td>{{$user->created_at->diffForHumans() ?? 'No date'}}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('user.edit', $user->id)}}">Edit</a>
                                                    @if($user->name != Auth::user()->name)
                                                        <hr>
                                                        <form action="{{route('user.destroy', $user->id)}}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input style="cursor: pointer" type="submit" value="Delete" class="dropdown-item">
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div style="padding-left: 50%">{{$users->render()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
