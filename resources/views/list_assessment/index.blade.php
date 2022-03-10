@extends('admin.admin_master')

@section('title')
    List Assessments
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Assessments</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('list_assessment.create') }}" class="btn btn-success">
                    <span class="text">Add List Assessments</span>
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
                        @foreach ($listAssessments as $key => $assessments)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $assessments->detail }}</td>
                                <td>
                                    <a href="{{ route('list_assessment.edit', [$assessments->id]) }}" class="btn btn-sm btn-warning" style="width: 15%">
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="{{ route('list_assessment.destroy', [$assessments->id]) }}" class="btn btn-sm btn-danger" style="width: 15%" id="delete">
                                        <span class="text">Delete</span>
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
