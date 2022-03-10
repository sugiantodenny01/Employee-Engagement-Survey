@extends('admin.admin_master')

@section('title')
    Add Employee
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}
    
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Employee</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
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
                        <label for="place_of_birth">Place of Birth</label>
                        <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" id="place_of_birth" placeholder="Enter place of birth.." value="{{ old('place_of_birth') }}">
                        @error('place_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" placeholder="Enter place of birth.." value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
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
                        <label for="join_date">Join Date</label>
                        <input type="date" class="form-control @error('join_date') is-invalid @enderror" name="join_date" id="join_date" placeholder="Enter join date.." value="{{ old('join_date') }}">
                        @error('join_date')
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
                        <label for="education">Education</label>
                        <input type="text" class="form-control @error('education') is-invalid @enderror" name="education" id="education" placeholder="Enter education.." value="{{ old('education') }}">
                        @error('education')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter address..">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter phone number.." value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
            
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    
    </div>
@endsection