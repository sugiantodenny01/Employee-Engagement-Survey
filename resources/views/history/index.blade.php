@extends('admin.admin_master')

@section('title')
    History Of User
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">History Of User</h6>
            </div>
            <div class="card-body">

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
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($users as $key => $employee)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->division->name }}</td>
                                <td>{{ $employee->role }}</td>
                                <td style="width: 5%" class="text-center">
                                    <!--  encrypt id agar tidak terlihat di url  !-->
                                    <a href="{{route('history.listTest',[encrypt($employee->id)])}}" class="btn btn-sm btn-warning">
                                        <span class="text">Check</span>
                                    </a>
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

