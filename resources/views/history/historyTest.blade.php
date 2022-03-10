@extends('admin.admin_master')

@section('title')
    Assessment
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{$user->name}} / {{$user->division->name}}</h6>
            </div>
        </div>
        <!-- -->
        <input type="hidden" id="userIdTest" value="{{encrypt($userId)}}">
        <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex" style="justify-content: space-between">
                        <div class="form-group">
                            <h6 class="m-0 font-weight-bold text-primary mb-3" id="testby">Assessment</h6>
                            <label for="detail">List Of Assessment</label>
                            <select class="form-control" id="change-test">
                                <option value="0"> - Pilih detail Assessment</option>
                                @foreach($test as $dataTest)
                                    <option value="{{encrypt($dataTest->id)}})">{{$dataTest->detail}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-none btn-history" style="margin-top: 65px;">
                            <button class="btn btn-primary">History</button>
                        </div>
                    </div>
                </div>
        </div>
        <div id="data-result-html" class="ml-1">

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


        function generateHistory(userId,testId){
            $.ajax({
                method: 'GET',
                url: "{{ route('history.generateHistory',['','']) }}"+'/'+userId +'/'+testId,
                success: function (data) {
                    console.log(data)
                    $('#data-result-html').html(data);

                }
            });
        }


        $('#change-test').change(function (){
            $('.btn-history').addClass('d-none');
            var userId=$('#userIdTest').val();
                testId=$(this).val();
                $('#data-result-html').empty();
                if (testId != 0){
                    generateHistory(userId,testId)
                }
        })


        $('.btn-history').click(function (e){
            $(this).addClass('d-none');
            var userId=$('#userIdTest').val();
                testId=$('#change-test').val();

                generateHistory(userId,testId)

        })
    </script>
@endpush
