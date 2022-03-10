@extends('admin.admin_master')

@section('title')
    Employees
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Employees</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('employee.create') }}" class="btn btn-success">
                <span class="text">Add Employee</span>
            </a>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Division</th>
                            <th>Role</th>
                            <th>Avatar</th>
                            <td>Status</td>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="5%">No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Division</th>
                            <th>Role</th>
                            <th>Avatar</th>
                            <td>Status</td>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($employees as $key => $employee)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $employee->id_number }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->division->name }}</td>
                            <td>{{ $employee->role }}</td>
                            <td><img class="img-thumbnail" src="{{ url('upload/employee_avatars/' . $employee->avatar) }}" alt="avatar" width="60px"></td>
                            <td> 
                                @if ($employee->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span> 
                                @endif
                            </td>
                            <td>
                                <form class="d-inline" method="post" action="{{ route('employee.reset-password', [$employee->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-sm btn-info" value="Reset Password" />
                                </form>
                                {{-- <a href="{{ route('employee.reset-password', [$employee->id]) }}" class="btn btn-sm btn-primary">
                                    <span class="text">Reset Password</span>
                                </a> --}}
                                <a href="{{ route('employee.edit', [$employee->id]) }}" class="btn btn-sm btn-warning">
                                    <span class="text">Edit</span>
                                </a>
                                <a href="{{ route('employee.destroy', [$employee->id]) }}" class="btn btn-sm btn-danger" id="delete">
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