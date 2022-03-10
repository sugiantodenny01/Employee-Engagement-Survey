<form method="POST" action="" enctype="multipart/form-data" id="form-data">
    @csrf
    <input type="hidden" value="{{$userId}}" name="userId">
    <input type="hidden" value="{{$testId}}" name="testId">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    <h6 class="m-0 font-weight-bold text-primary mb-3 title-assessment">Assessment</h6>
                    <label for="detail">List Of Category For Assessment</label>

                    <select class="form-control" id="category-soal">
                        <option value="0"> - Pilih Category</option>
                        @foreach($categorys as $category)
                            <option class="change-category" value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>

    <div id="soal-html" class="ml-1">

        <div class="card-body end-card d-none">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        let history='{{$history}}';
        if (history != ''){
            $('.title-assessment').addClass('d-none')
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $('#category-soal').change(function (){
            let categoryId=$(this).val();
                testId='{{$testId}}';
                userId='{{$userId}}';
            getAndReload(categoryId,testId,userId)
        })

        $('.end-card').click(function (e){

            if($(this).closest('form')[0].checkValidity()){
                e.preventDefault();

                let url= "{{route('overall.processTest')}}";
                categoryId=$('#category-soal').val();
                testId='{{$testId}}';
                userId='{{$userId}}';

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#form-data').serialize(),
                    success: function (data) {

                        console.log(data.success)

                        if (data.success == true){
                            toastr.success('successful')
                        }else{
                            toastr.warning('unsuccessful')
                        }
                        getAndReload(categoryId,testId,userId)
                    },
                    error: function (data) {
                        console.log(data);

                    }
                });
            }


        })

        function getAndReload(categoryId,testId,userId){
            $.ajax({
                method: 'GET',
                url: "{{ route('overall.testByCategory',['','','']) }}"+'/'+categoryId+'/'+testId+'/'+userId,
                success: function (data) {
                    $('.test-category').remove();
                    $('.end-card').addClass('d-none');
                    $(data).insertBefore('.end-card');

                    if ($('.test-category').children().length !== 0){
                        $('.end-card').removeClass('d-none');
                    }



                }
            });
        }

    });
</script>

