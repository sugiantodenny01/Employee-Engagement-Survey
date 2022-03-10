@extends('admin.admin_master')

@section('title')
    Add Category Detail
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}
    
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Category Detail</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('category_detail.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control  @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                        @foreach ($categories as $category )
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : null }}>{{ $category->name }}</option>
                        @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name.." value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quality">Quality</label>
                        <input type="text" class="form-control @error('quality') is-invalid @enderror" name="quality" id="quality" placeholder="Enter quality.." value="{{ old('quality') }}">
                        @error('quality')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    
    </div>
@endsection