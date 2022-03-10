@extends('admin.admin_master')

@section('title')
    Add List Assessments
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add List Assessments</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('list_assessment.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="detail">Detail of name Assessment</label>
                            <input type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" id="detail" placeholder="Enter name.." value="{{ old('detail') }}">
                            @error('detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group mb-3 col-6">
                            <label for="StartAssessment" class="font-14 font-weight-medium fontn-grey">Tanggal Mulai</label>
                            <input type="month" name="start" id="StartAssessment" class="form-control  @error('start') is-invalid @enderror">
                            @error('start')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>

    </div>
@endsection
