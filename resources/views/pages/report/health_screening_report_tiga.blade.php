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
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 5px;">No. Medical Record</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->penid }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 5px;">Employee Name</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pasnama }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 5px;">Age/Sex/Employee ID</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $jk }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 5px;">Telephone</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pastlp }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 5px;">Address</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pasalamat }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 5px;">Occupation</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->paspekerjaan }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 5px;">Name of Employer/Recruitment Agency</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->pennama }}</td>
                </tr>
                <tr>
                    <td style="width: 250px; padding-left: 5px;">Address of Employer/Recruitment Agency</td>
                    <td style="width:1px;">:</td>
                    <td>{{ $data->penalamat }}</td>
                </tr>
            </tbody>
        </table>

        <br>
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
        <table width="100%" id="PhysicalExam" style="padding-left:5px; padding-right: 5px;">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:center;">
                        No
                    </th>
                    <th style="text-align:center;">
                        Physical
                    </th>
                    <th style="text-align:center;">
                        Abnormal / Normal
                    </th>
                    <th style="text-align:center;">
                        Describe Abnormalities in details
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                @php
                $no = 1;
                @endphp
                @forelse($detail_physical as $Valdetail_physical)
                <tr>
                    <td style="width:1px; text-align: center; vertical-align: middle;">{{ $no; }}</td>
                    <td style="vertical-align: middle;" nowrap>{{ $Valdetail_physical->name_physical }}</td>
                    <td style="vertical-align: middle; text-align: center;">Abnormal</td>
                    <td style="vertical-align: middle; text-align: left;">
                     
                        {{ $json_data['describe_abnormalities'][$Valdetail_physical->id_physical]; }}

                    </td>
                </tr>
                @php 
                $no++;
                @endphp
                @empty
                <tr>
                    <td style="width:1px; text-align: center; vertical-align: middle;" colspan="4">Data Not Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <br>
        {{-- REMARK --}}
        <table border="0" width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                        REMARK
                    </th>
                </tr>
            </thead>
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5;">
                <tr>
                    <td style="padding-left: 5px; vertical-align: top; text-align: justify;">{{ $json_data['remark_health_screening_page_tiga'] }}</td>
                </tr>
                <tr>
                    <td><hr></td>
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