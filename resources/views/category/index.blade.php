@extends('admin.admin_master')

@section('title')
    Categories
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Categories</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-success">
                <span class="text">Add Category</span>
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
                        @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('category.edit', [$category->id]) }}" class="btn btn-sm btn-warning w-25">
                                    <span class="text">Edit</span>
                                </a>
                                <a href="{{ route('category.destroy', [$category->id]) }}" class="btn btn-sm btn-danger w-25" id="delete">
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
