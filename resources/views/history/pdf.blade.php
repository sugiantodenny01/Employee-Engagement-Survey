<!DOCTYPE html>
<html lang="id">
<head>
    <title>Assessment</title>
    <meta name="csrf-token" content={{csrf_token()}}>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div class="container-fluid" id="table-history">
    <div class="card shadow">
        <p style="text-align: center !important; margin-bottom: 5px; font-weight: bold; font-size: 16px;margin-bottom: 5px">Integration Assessment Report</p>
        <p style="font-weight: bold; font-size: 12px">Name Of Assessment: {{$test->detail}}</p>
        <p style="font-weight: bold; font-size: 12px">Period Of Assessment: {{\Carbon\Carbon::parse($test->start)->format('d-m-Y')}}</p>
        <p style="font-weight: bold; font-size: 12px">Name: {{$userName}}</p>
        <div class="card-body" id="list-data-history" style="margin-top: 1px">
            @foreach($arrList as $category => $data)
                @if(array_key_exists('soal', $data))
                    <div class="table-responsive mb-3">
                        <p class="font-weight-bold" style="margin-bottom: 5px; font-size: 16px; font-weight: bold; margin-bottom: 10px">Kategori: {{$category}}</p>
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

                            <tbody>
                            @if(array_key_exists('soal', $data))
                                @foreach ($data['soal'] as $key => $list)
                                    @php
                                        if ($list['soal'] =="Jumlah hari kerja dalam satu bulan"){
                                          $pembagi=$list['nadj'];

                                        }
                                    @endphp
                                    <tr>
                                        <td  style="text-align: center">{{ $key + 1 }}</td>
                                        <td style="padding-bottom: 3px; padding-top: 3px; padding-left: 3px">{{ $list['soal'] }}</td>
                                        <td  style="text-align: center">{{ $list['nilai'] }}</td>
                                        @if($list['soal'] == "Jumlah hari masuk kantor yang dibuktikan dengan absen datang dan absen pulang" || $list['soal'] == "Jumlah hari penugasan dinas yang dibuktikan dengan Surat Perintah Perjalanan Dinas" || $list['soal'] == "Jumlah hari Ganti Libur sebagai kompensasi lembur yang dibuktikan dengan Surat Perintah Kerja Lembur" || $list['soal'] == "Jumlah hari penugasan lembur pada hari libur yang dibuktikan dengan surat Perintah Kerja Lembur")
                                            <td style="text-align: center">{{  $pembagi }}</td>
                                        @else
                                            <td style="text-align: center">{{ $list['quality'] }}</td>
                                        @endif

                                        <td  style="text-align: center">{{ $list['nadj'] }}</td>
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

            <table class="table table-bordered" id="" width="100%" cellspacing="0" style="margin-top: 50px">
                <thead>
                @foreach($arrList as $category => $data)
                    <tr>
                        <th width="90%" style="text-align: left; padding-left: 3px">{{$category}}</th>
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
    </div>
</div>
</body>
</html>
