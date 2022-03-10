@extends('admin.admin_master')

@section('title')
    Add User
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}
    
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="id_number">ID</label>
                        <input type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" id="id_number" placeholder="Enter ID.." value="{{ old('id_number') }}">
                        @error('id_number')
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
                        <label for="gender">Gender</label>
                        <select class="form-control  @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : null }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : null }}>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="division_id">Division</label>
                        <select class="form-control  @error('division_id') is-invalid @enderror" name="division_id" id="division_id">
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : null }}>{{ $division->name }}</option>
                        @endforeach
                        </select>
                        @error('division_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="director" {{ old('role') == 'director' ? 'selected' : null }}>Director</option>
                            <option value="head of division" {{ old('role') == 'head of division' ? 'selected' : null }}>Head of Division</option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : null}}>Staff</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email.." value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_photo_path">Profile Photo</label>
                        <input type="file" class="form-control @error('profile_photo_path') is-invalid @enderror" name="profile_photo_path" id="profile_photo_path">
                        @error('profile_photo_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
            
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    
    </div>
@endsection