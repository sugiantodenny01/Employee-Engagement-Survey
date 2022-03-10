@extends('admin.admin_master')

@section('title')
    Divisions
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Divisions</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('division.create') }}" class="btn btn-success">
                <span class="text">Add Division</span>
            </a>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="5%">No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($divisions as $key => $division)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $division->name }}</td>
                            <td>
                                <a href="{{ route('division.edit', [$division->id]) }}" class="btn btn-sm btn-warning">
                                    <span class="text">Edit</span>
                                </a>
                                <a href="{{ route('division.destroy', [$division->id]) }}" class="btn btn-sm btn-danger" id="delete">
                                    <span class="text">Delete</span>
                                </a>
                                {{-- <form class="d-inline" action="{{ route('user.destroy', [$user->id]) }}" method="POST" id="delete">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete" >
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection