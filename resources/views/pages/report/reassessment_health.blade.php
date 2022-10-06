<!DOCTYPE html>
<html>
<head>
  <link href="http://fonts.cdnfonts.com/css/times-new-roman" rel="stylesheet">
  <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left:-30px; top: -170px; right: -30px; height: 120px; text-align: center;}
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
    <div style="margin-top: -60px; margin-left: 5px;">
        <center>
            <h3>REASSESSMENT HEALTH REPORT</h3>
           
            <div style="margin-left: 9px; font-size: 12px;">
                <table border="0" width="100%">
                    <tr>
                        <td style="width: 350px" rowspan="3"></td>
                        <td style="text-align:center; vertical-align: middle;">
                            Salam Sejawat,<br><br><br><br><br><br><br>
                        </td>
                        <td></td>
                    <tr>
                        <td style="text-align:center; vertical-align: middle;">
                            dr. Tigor Pandapotan Sianturi, Sp.PK
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; vertical-align: middle;">
                            SIP. 002.III/019-540/SIP.TM/TPMPTSP-BTM/XII/2021 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" style="padding-top: 50px"><hr></td>
                    </tr>
                    </tr>
                </table>
            </div>
        </center>
    {{-- <p style="page-break-before: always; margin-top: -40px;">the second page</p> --}}
  </div>
</div>
</body>
</html>
<style type="text/css">
    .tdSatu{
      border: 0.1px solid grey ;
      border-collapse: collapse;
    }
</style>