<!DOCTYPE html>
<html>
<head>
  <link href="http://fonts.cdnfonts.com/css/times-new-roman" rel="stylesheet">
  <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left:-45px; top: -170px; right: -40px; height: 120px; text-align: center;}
    #footer { position: fixed; left: -30px; bottom: -240px; right: -30px; height: 120px; }
    #footer .page:after { content: counter(page, upper-roman);}
  </style>
  <title>Osmaro</title>
<body>
  <div id="header">
    <img src="{{ public_path('images/logo_report/header.PNG') }}" style="width:100%;">
  </div>
  <div id="footer">
    <img src="{{ public_path('images/logo_report/footer.PNG') }}" style="width:100%;">
    {{-- isi content footer --}}
  </div>
  <div id="content">
    <div style="margin-top: -30px; margin-left: 5px;">
        
        <table border="0">
            <tr>
                <td style="width: 320px; vertical-align: top;">
                    <table border="0">
                        <tr>
                            <td style="padding: 5px;">Nama Pasien</td>
                            <td style="padding: 5px; width: 1px;">:</td>
                            <td style="padding: 5px;">{{ ucwords(strtolower($data_basic->pasnama)) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Umur</td>
                            <td style="padding: 5px; width: 1px;">:</td>
                            <td style="padding: 5px;">{{ $age }} Tahun</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Jenis Kelamin</td>
                            <td style="padding: 5px; width: 1px;">:</td>
                            <td style="padding: 5px;">{{ ucwords(strtolower($jeniskelamin)) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Alamat</td>
                            <td style="padding: 5px; width: 1px;">:</td>
                            <td style="padding: 5px;">{{ ucwords(strtolower($data_basic->pasalamat)) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width:20px;">
                    
                </td>
                <td style="vertical-align: top; width: 270px;">
                    <table border="0">
                        <tr>
                            <td style="padding: 5px;">Kode Lab</td>
                            <td style="padding: 5px; width: 1px;">:</td>
                            <td style="padding: 5px;">2209030001</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Tanggal</td>
                            <td style="padding: 5px; width: 1px;">:</td>
                            <td style="padding: 5px;">{{ $tanggalrujukindo }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Pengirim</td>
                            <td style="padding: 5px; width: 1px;">:</td>
                            <td style="padding: 5px;">Value</td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
    </div>
    <br>
    <div>
        <center>
            <p><h2>HASIL PEMERIKSAAN LABORATORIUM</h2></p>
            <table class="tableee">
                <tr class="tableee">
                    <th class="tableee">Pemeriksaan</th>
                    <th class="tableee">Hasil</th>
                    <th class="tableee">Satuan</th>
                    <th class="tableee">Nilai Normal</th>
                </tr>
            </table>
        </center>
    </div>
    <p style="page-break-before: always; margin-top: -40px;">the second page</p>
  </div>
</body>
</html>
<style type="text/css">
    .tableee {
      width: 105px;
      border: 1px solid black;
      border-collapse: collapse;
      margin-left: -20px;
      padding-top: 10px;
      padding-left: 30px;
      padding-right: 30px;

    }
</style>