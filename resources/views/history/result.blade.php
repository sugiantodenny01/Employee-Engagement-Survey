
    <!-- Begin Page Content -->
    <div class="container-fluid" id="table-history">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; justify-content: space-between">
                <div>
                <h6 class="m-0 font-weight-bold text-primary" style="display:inline-block;">History Of Assessment</h6>
                </div>
                <!-- !-->
                <div>
                <h6 class="ml-auto font-weight-bold text-primary show-pdf mx-3" id="show-pdf" style="display: inline-block; cursor: pointer" ><a href="{{route('history.generatePdf',['userId'=>$userId,'testId'=>$testId])}}">PDF</a></h6>
                <h6 class="ml-auto font-weight-bold text-primary edit-history" id="edit-history" style="display: inline-block; cursor: pointer">Edit</h6>
                </div>

            </div>
            @if(isset($arrList) && count($arrList)>0)
            <div class="card-body" id="list-data-history">
                <br>
                @foreach($arrList as $category => $data)
                    @if(array_key_exists('soal', $data))
                        <div class="table-responsive mb-3">
                            <h6 class="font-weight-bold">{{$category}}</h6>
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="60%">Component</th>
                                        <th width="10%">Score</th>
                                        <th width="10%">Quality</th>
                                        <th width="10%">N Adj</th>
                                    </tr>
                                </thead>

                                <tbody >
                                    @if(array_key_exists('soal', $data))
                                              @foreach ($data['soal'] as $key => $list)
                                                  @php
                                                  if ($list['soal'] =="Jumlah hari kerja dalam satu bulan"){
                                                    $pembagi=$list['nadj'];

                                                  }
                                                  @endphp

                                                    <tr>
                                                           <td>{{ $key + 1 }}</td>
                                                           <td>{{ $list['soal'] }}</td>
                                                           <td>{{ $list['nilai'] }}</td>
                                                       @if($list['soal'] == "Jumlah hari masuk kantor yang dibuktikan dengan absen datang dan absen pulang" || $list['soal'] == "Jumlah hari penugasan dinas yang dibuktikan dengan Surat Perintah Perjalanan Dinas" || $list['soal'] == "Jumlah hari Ganti Libur sebagai kompensasi lembur yang dibuktikan dengan Surat Perintah Kerja Lembur" || $list['soal'] == "Jumlah hari penugasan lembur pada hari libur yang dibuktikan dengan surat Perintah Kerja Lembur")
                                                            <td>{{  $pembagi }}</td>
                                                        @else
                                                            <td>{{ $list['quality'] }}</td>
                                                        @endif
                                                             <td>{{ $list['nadj'] }}</td>
                                                    </tr>
                                              @endforeach
                                    @endif
                                </tbody>

                            </table>
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="90%" class="text-center">Category Total</th>
                                        <th>{{$data['sumCategory']}}</th>
                                       <?php
                                            /*
                                                    <th>nilai</th>
                                             */
                                        ?>
                                    </tr>
                                </thead>
                                <?php
                                /*
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>{{$data['sumCategory']}}</td>
                                    </tr>
                                </tbody>
                                */
                                ?>
                            </table>
                        </div>
                    @endif
                @endforeach

                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    @foreach($arrList as $category => $data)
                    <tr>
                        <th width="90%" class="text-left">{{$category}}</th>
                        <th>{{number_format($data['sumCategory'])}}</th>
                    </tr>
                    @endforeach
                    <tr>
                        <th width="90%" class="text-center">Total</th>
                        <th>{{$nilaiTotal}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
            @endif
        </div>
    </div>

    <script>


        $('#edit-history').click(function (){
            $('.btn-history').removeClass('d-none');
            $("#table-history").empty()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                method: 'GET',
                url: "{{ route('general.getForm',['','','']) }}"+'/'+'{{$userId}}'+'/'+'{{$testId}}'+'/'+'{{true}}',
                success: function (data) {

                    if (data.success == false){
                        toastr.success('unsuccessful');
                    }else{
                        $('#table-history').append(data);
                    }

                }
            });

        });
    </script>
