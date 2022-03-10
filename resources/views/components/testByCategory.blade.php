@if(count($categoryDetails)>0)
<div class="test-category">
        <input type="hidden" value="{{$categoryId}}" name="categoryId">
        @foreach($categoryDetails as $index => $test)
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <p class="font-weight-bold">{{$index + 1}}. {{$test->name}}</p>
                    </div>
                    <div class="form-group col-12 form-inline">
                        <label for="for-assessment-test" class="mr-2">Nilai</label>
                        <input type="number" class="form-control w-25" name="score[{{$test->id}}]" required id="for-assessment-test" min="0"
                               max= @if($test->category->name=="Kedisiplinan Kerja") "30" @else "10" @endif"
                        value="{{\App\Repository\CoreAssessment::getValue($testId,$userId,$test->id)}}"
                        >
                    </div>
                </div>
            </div>
        @endforeach
</div>
@endif
