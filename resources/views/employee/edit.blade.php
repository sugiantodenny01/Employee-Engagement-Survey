@extends('admin.admin_master')

@section('title')
    Edit Employee
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Users</h1> --}}
    
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Employee</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.update', [$employees->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                            <option value="active" @if ($employees->status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if ($employees->status == 'inactive') selected @endif">Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_number">ID</label>
                        <input type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" id="id_number" disabled value="{{ $employees->id_number }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name.." value="{{ $employees->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="place_of_birth">Place of Birth</label>
                        <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" id="place_of_birth" placeholder="Enter place of birth.." value="{{ $employees->place_of_birth }}">
                        @error('place_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" placeholder="Enter place of birth.." value="{{ $employees->date_of_birth }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control  @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option value="male" @if ($employees->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if ($employees->gender == 'female') selected @endif>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="join_date">Join Date</label>
                        <input type="date" class="form-control @error('join_date') is-invalid @enderror" name="join_date" id="join_date" placeholder="Enter join date.." value="{{ $employees->join_date }}">
                        @error('join_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="division_id">Division</label>
                        <select class="form-control  @error('division_id') is-invalid @enderror" name="division_id" id="division_id">
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" @if ($employees->division_id == $division->id) selected @endif>{{ $division->name }}</option>
                        @endforeach
                        </select>
                        @error('division_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="head of division" @if ($employees->role == 'head of division') selected @endif>Head of Division</option>
                            <option value="staff" @if ($employees->role == 'staff') selected @endif>Staff</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email.." value="{{ $employees->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="education">Education</label>
                        <input type="text" class="form-control @error('education') is-invalid @enderror" name="education" id="education" placeholder="Enter education.." value="{{ $employees->education }}">
                        @error('education')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter address..">{{ $employees->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter phone number.." value="{{ $employees->phone }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <div class="input-group">
                            <img class="img-thumbnail" src="{{ url('upload/employee_avatars/' . $employees->avatar) }}" width="130px">
                            <br>
                        </div>
                    </div> 

                    <div class="form-group">
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
            
                    <input type="submit" class="btn btn-primary" value="Update">
                </form>
            </div>
        </div>
    
    </div>
@endsection