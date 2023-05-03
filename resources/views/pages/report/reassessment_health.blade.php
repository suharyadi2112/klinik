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
    <div style="margin-top: -60px; margin-left: 5px; margin-bottom: -60px;">
        <center style="font-family: Arial, Helvetica, sans-serif;">
            <h4>REASSESSMENT HEALTH REPORT</h4>
        </center>

        {{-- PERSONAL DATA --}}
        <table border="0" width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left;" colspan="3">
                        According to the health screening report of this employee :
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83" colspan="3">
                        PERSONAL DATA
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 15px;">No. Medical Record</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->penid }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;">Employee Name</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pasnama }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;">Age/Sex/Employee ID</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $jk }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;">Telephone</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pastlp }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;">Address</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pasalamat }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;">Occupation</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->paspekerjaan }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;">Name of Employer/Recruitment Agency</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pennama }}</td>
                </tr>
                <tr>
                    <td style="width: 250px; padding-left: 15px;">Address of Employer/Recruitment Agency</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->penalamat }}</td>
                </tr>
            </tbody>
        </table>

        {{-- MEDICAL CHECK-UP DATA --}}
        <table border="0" width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83" colspan="3">
                        MEDICAL CHECK-UP DATA
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 15px;">Date of Exam</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pentglrujukan }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px; vertical-align: top;">Certification</td>
                    <td style="width:1px; vertical-align: top;">:</td>
                    <td style="vertical-align: top; text-align: justify;">{{ $data->certification }}</td>
                </tr>
                <tr>
                    <td style="width: 250px; padding-left: 15px; vertical-align: top;">Remark Exam/Medical History</td>
                    <td style="width:1px; vertical-align: top;">:</td>
                    <td style="vertical-align: top; text-align: justify;">{{ $data->remark_exam }}</td>
                </tr>
            </tbody>
        </table>

        {{-- THEN FUTHER EXAMINATION WAS CONDUCTED --}}
        <table border="0" width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83" colspan="3">
                        THEN FUTHER EXAMINATION WAS CONDUCTED
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left;" colspan="3">
                        The employee was referred :
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 15px;">Doctor's Name</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 15px; vertical-align: top;">Date Of Exam</td>
                    <td style="width:1px; vertical-align: top;">:</td>
                    <td style="vertical-align: top; text-align: justify;">{{ $data->pentglrujukan }}</td>
                </tr>
                <tr>
                    <td style="width: 250px; padding-left: 15px; vertical-align: top;">Place Of Exam</td>
                    <td style="width:1px; vertical-align: top;">:</td>
                    <td style="vertical-align: top; text-align: justify;">{{ $data->place_of_exam }}</td>
                </tr>
                <tr>
                    <td style="width: 250px; padding-left: 15px; vertical-align: top;">Conclusion/Remark</td>
                    <td style="width:1px; vertical-align: top;">:</td>
                    <td style="vertical-align: top; text-align: justify;">{{ $data->conclusion_remark }}</td>
                </tr>
            </tbody>
        </table>

        {{-- RECERTIFICATION --}}
        <table border="0" width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                        RECERTIFICATION
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 15px; vertical-align: top; text-align: justify;">{{ $data->recertification }}</td>
                </tr>
            </tbody>
        </table>    
        {{-- RECERTIFICATION --}}
        <table border="0" width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                        Advice
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 15px; vertical-align: top; text-align: justify;">{{ $data->advice }}</td>
                </tr>
            </tbody>
        </table>        
        <br>
        <div style="margin-left: 9px; font-size: 12px;">
            <table border="0" width="100%">
                <tr>
                <td style="width: 350px" rowspan="2"></td>
                    <td style="text-align:center; vertical-align: middle; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                        Batam, {{ $tgl_ttd }}<br><br><br><br><br>
                    </td>
                <tr>
                    <td style="text-align:center; vertical-align: middle; font-style: italic; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                        <hr style="width: 50%; background-color:black;">
                        {{ auth()->user()->name }}{{-- dr. Tigor Pandapotan Sianturi, Sp.PK --}}
                    </td>
                </tr>
               {{--  <tr>
                    <td style="text-align:center; vertical-align: middle;">
                        SIP. 002.III/019-540/SIP.TM/TPMPTSP-BTM/XII/2021 
                    </td>
                </tr> --}}
             
                </tr>
            </table>
        </div>
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