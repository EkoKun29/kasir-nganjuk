@extends('layouts.app')
@section('title')
    User
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('manajemen.user.create')
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @foreach ($item->roles as $role)
                                <span class="badge badge-primary text-uppercase">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                data-target="#showModal-{{ $item->id }}" disabled>
                                <i class="fas fa-eye mr-2"></i>Permissions</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @include('manajemen.user.show')
        </table>
    </div>
@stop
