@extends('admin.admin_master')

@section('title')
    Assessment
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
                <div class="card shadow mb-4 data-card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{$user->name}} / {{$user->division->name}}</h6>
                        </div>
                </div>
    </div>
@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $.ajax({
            method: 'GET',
            url: "{{ route('general.getForm',['','']) }}"+'/'+'{{$userId}}'+'/'+'{{$testId}}',
            success: function (data) {
                $('.data-card').after(data);
            }
        });
    </script>
@endpush
