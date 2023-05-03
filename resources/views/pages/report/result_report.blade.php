<!DOCTYPE html>
<html>
<head>
  <link href="http://fonts.cdnfonts.com/css/times-new-roman" rel="stylesheet">
  <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left:-30px; top: -170px; right: -30px; height: 120px; text-align: center;}
    #footer { position: fixed; left: -30px; bottom: -140px; right: -30px; height: 120px; }
    #footer .page:after { content: counter(page, upper-roman);}
  </style>
  <title>Klinik Web</title>
<body>
  <div id="header">
    <img src="{{ public_path('images/logo_report/header_baru.PNG') }}" style="width:100%;">
  </div>
  <div id="footer">
    <img src="{{ public_path('images/logo_report/footer_baru.PNG') }}" style="width:100%;">
    {{-- isi content footer --}}
  </div>
  <div id="content">
    <div style="margin-top: -30px; margin-left: 5px;">
        
        <table border="0" style="width: 660px; font-size: 13px;">
            <tr>
                <td style="width: 280px; vertical-align: top;">
                    <table border="0" width="100%">
                        <tr>
                            <td style="padding: 5px; width: 100px; vertical-align: top;">Nama Pasien</td>
                            <td style="padding: 5px; width: 1px; vertical-align: top;">:</td>
                            <td style="padding: 5px; vertical-align: top;">{{ ucwords(strtolower($data_basic->pasnama)) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; vertical-align: top;">Umur</td>
                            <td style="padding: 5px; width: 1px; vertical-align: top;">:</td>
                            <td style="padding: 5px; vertical-align: top;">{{ $age }} Tahun</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; vertical-align: top;">Jenis Kelamin</td>
                            <td style="padding: 5px; width: 1px; vertical-align: top;">:</td>
                            <td style="padding: 5px; vertical-align: top;">{{ ucwords(strtolower($jeniskelamin)) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; vertical-align: top;">Alamat</td>
                            <td style="padding: 5px; width: 1px; vertical-align: top;">:</td>
                            <td style="padding: 5px; vertical-align: top;">{{ ucwords(strtolower($data_basic->pasalamat)) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width:20px;">
                    
                </td>
                <td style="vertical-align: top; width: 270px;">
                    <table border="0">
                        <tr>
                            <td style="padding: 5px; width: 100px; vertical-align: top;">Kode Lab</td>
                            <td style="padding: 5px; width: 1px; vertical-align: top;">:</td>
                            <td style="padding: 5px; vertical-align: top;">2209030001</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; vertical-align: top;">Tanggal</td>
                            <td style="padding: 5px; width: 1px; vertical-align: top;">:</td>
                            <td style="padding: 5px; vertical-align: top;">{{ $tanggalrujukindo }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; vertical-align: top;">Pengirim</td>
                            <td style="padding: 5px; width: 1px; vertical-align: top;">:</td>
                            <td style="padding: 5px; vertical-align: top;">{{ $data_basic->pennama }}</td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
    </div>
    <br>
    <div>
        <center>
            <p><h3>HASIL PEMERIKSAAN LABORATORIUM</h3></p>
            <table class="tableee">
                <thead>
                    <tr class="tableee">
                        <th class="tableee">Pemeriksaan</th>
                        <th class="tableee">Hasil</th>
                        <th class="tableee">Satuan</th>
                        <th class="tableee">Nilai Normal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $restndkl = DB::table('tindakankeluar')->select('tindakankeluar.tndklrtndid','tindakan.tndnama','kategoritindakan.kattndnama')->where('tndklrpenid','=',$id_registration)
                        ->join('tindakan','tindakan.tndid','=','tindakankeluar.tndklrtndid')
                        ->join('kategoritindakan','kategoritindakan.kattndid','=','tindakan.tndkattndid')
                        ->get();
                    @endphp
                    @foreach($restndkl as $keySatu => $Valrestndkl)
                    @php
                        $reskatlab = DB::table('katlab')->select('*')->where('katlabtndid','=',$Valrestndkl->tndklrtndid)->get();
                    @endphp
                    <tr>
                        <td colspan="4" style="padding-top: 10px; font-weight: bold;">{{ $Valrestndkl->kattndnama }}</td>
                    </tr>
                        @foreach($reskatlab as $keydua => $ValKatLab)
                        @php
                            $reskatlab = DB::table('result')->select('*')->where([['resultkatlabid','=',$ValKatLab->katlabid],['resultpenid','=',$id_registration]])->first();
                        @endphp
                        <tr style="font-size: 13px;">
                            <td class="tdSatu" style=" padding: 5px 0px 5px 0px;">{{ $ValKatLab->katlabnama }}</td>
                            <td class="tdSatu" style=" padding: 5px 0px 5px 0px; text-align: center;">
                                @if($reskatlab)
                                    {{ $reskatlab->result }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="tdSatu" style=" padding: 5px 0px 5px 0px; text-align: center;">{{ $ValKatLab->katlabsat }}</td>
                            <td class="tdSatu" style=" padding: 5px 0px 5px 0px; text-align: center;">{{ $ValKatLab->katlabnilai }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                    @php 
                    // dd($reskatlab);  
                    @endphp
                </tbody>

            </table>
            <br>
            <div style="margin-left: 9px; margin-right: 12px; font-size: 12px;">
                <table>
                    <tr>
                        <td style="vertical-align: top;">Catatan</td>
                        <td style="vertical-align: top;"> : </td>
                        <td style="vertical-align: top; text-align: justify;">{{ $data_basic->catatan }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Saran</td>
                        <td style="vertical-align: top;"> : </td>
                        <td style="vertical-align: top; text-align: justify;">{{ $data_basic->saran }}</td>
                    </tr>
                </table>
            </div>

            <div style="margin-left: 9px; margin-top: 30px; font-size: 12px;">
                <table border="0" width="100%">
                    <tr>
                        <td style="width: 350px" rowspan="3"></td>
                        <td style="text-align:center; vertical-align: middle;">
                            Salam Sejawat,<br><br><br><br><br><br><br>
                        </td>
                        <td></td>
                    <tr>
                        <td style="text-align:center; vertical-align: middle;">
                            dr. Sekian dan Terimakasih
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; vertical-align: middle;">
                            SIP. 002.III/019-540/XXX/BBB
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" style="padding-top: 50px"><hr></td>
                    </tr>
                    </tr>
                </table>
            </div>
        </center>
    </div>
    {{-- <p style="page-break-before: always; margin-top: -40px;">the second page</p> --}}
  </div>
</body>
</html>
<style type="text/css">
    .tableee {
      width: 105px;
      border: 2px solid black;
      border-collapse: collapse;
      margin-left: -20px;
      padding-top: 10px;
      padding-left: 30px;
      padding-right: 30px;

    }
    .tdSatu{
      border: 0.1px solid grey ;
      border-collapse: collapse;
    }
</style>