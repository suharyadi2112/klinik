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
    <div style="margin-top: -60px; margin-left: 5px; margin-bottom: -60px;">
        <center style="font-family: Arial, Helvetica, sans-serif;">
            <h4 style="margin-bottom: 0px; text-decoration: underline;">HEALTH SCREENING REPORT</h4>
            <h5 style="margin-top: 0px;"> Regular Employment Health Screening </h5>
        </center>

        {{-- PERSONAL DATA --}}
        <table border="0" width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83" colspan="3">
                        PERSONAL DATA
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1;">
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

        {{-- PHYSICAL EXAMINATION --}}
        <table width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                        PHYSICAL EXAMINATION
                    </th>
                </tr>
            </thead>
        </table>
        <table width="100%" id="PhysicalExam">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left;">
                        No
                    </th>
                    <th style="text-align:left;">
                        Physical
                    </th>
                    <th style="text-align:left;">
                        Abnormal / Normal
                    </th>
                    <th style="text-align:left;">
                        Describe Abnormalities in details
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 15px;">Date of Exam</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pentglrujukan }}</td>
                    <td>{{ $data->pentglrujukan }}</td>
                </tr>
            </tbody>
        </table>

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

    #PhysicalExam {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #PhysicalExam td, #PhysicalExam th {
      border: 1px solid;
      padding: 2px;
    }

</style>