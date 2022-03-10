@extends('admin.admin_master')

@section('title')
    Edit User
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}
    
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.update', [$users->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                            <option value="active" @if ($users->status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if ($users->status == 'inactive') selected @endif">Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_number">ID</label>
                        <input type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" id="id_number" disabled value="{{ $users->id_number }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name.." value="{{ $users->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control  @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option value="male" @if ($users->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if ($users->gender == 'female') selected @endif>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="division_id">Division</label>
                        <select class="form-control  @error('division_id') is-invalid @enderror" name="division_id" id="division_id">
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" @if ($users->division_id == $division->id) selected @endif>{{ $division->name }}</option>
                        @endforeach
                        </select>
                        @error('division_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="director" @if ($users->role == 'director') selected @endif>Director</option>
                            <option value="head of division" @if ($users->role == 'head of division') selected @endif>Head of Division</option>
                            <option value="staff" @if ($users->role == 'staff') selected @endif>Staff</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email.." value="{{ $users->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_photo_path">Profile Photo</label>
                        <div class="input-group">
                            <img class="img-thumbnail" src="{{ url('upload/profile_photo_path/' . $users->profile_photo_path) }}" width="130px">
                            <br>
                        </div>
                    </div> 

                    <div class="form-group">
                        <input type="file" class="form-control @error('profile_photo_path') is-invalid @enderror" name="profile_photo_path" id="profile_photo_path">
                        @error('profile_photo_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
            
                    <input type="submit" class="btn btn-primary" value="Update">
                </form>
            </div>
        </div>
    
    </div>
@endsection