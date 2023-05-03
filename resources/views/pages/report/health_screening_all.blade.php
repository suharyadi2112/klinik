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
        
        {{-------------------------- PEMBATAS PAGE 2 --------------------------}}

        <p style="page-break-before: always; margin-top: -80px;"></p>

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
            <tbody style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; line-height: 1.2;">
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

        {{-- MEDICAL HISTORY --}}
        <table width="100%" style="padding-bottom: 5px;">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                        MEDICAL HISTORY
                    </th>
                </tr>
            </thead>
        </table>

        <table width="100%" border="0" id="MedHis" style="padding-left:5px; padding-right: 5px; padding-bottom: 5px;">
            <tbody style="font-size: 10px;">
                
                
                <td style="text-align:left; padding-left: 5px;">
                @if($json_data['medical_history'] ?? null)
                    @forelse($json_data['medical_history'] as $keyyy => $valll)
                    @if($json_data['medical_history'][$keyyy] != 'on')
                        @php
                            $res_data = DB::table('medical_history')->select('name_medical_history')->where('id_medical_history','=',$json_data['medical_history'][$keyyy])->first();
                        @endphp
                        {{ $res_data->name_medical_history }},
                    @else
                        Others
                    @endif
                    @empty - @endforelse
                @else
                    -
                @endif
                </td>
            </tbody>
        </table>

        {{-- CLINIC EXAMINATION, LABORATORY TEST, OTHER TES--}}
        <table width="100%" style="padding-bottom: 5px;">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; width: 50%; text-decoration: underline; background-color: #b5be83">
                        CLINIC EXAMINATION
                    </th>
                    <th style="text-align:left; width: 50%; text-decoration: underline; background-color: #b5be83">
                        LABORATORY TEST
                    </th>
                </tr>
            </thead>
        </table>
      
        <table width="100%" {{-- id="MedHis" --}} style="padding-left:5px; padding-right: 5px; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <tbody style="font-size: 10px; vertical-align: top;">
                <td style="width: 50% vertical-align: top;">
                    {{-- CLINIC EXAMINATION --}}
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    Weight : {{ $json_data['weight'] }}
                                </td>
                                <td>
                                    Height : {{ $json_data['height'] }}
                                </td>
                                <td>
                                    BMI : {{ $json_data['bmi'] }}
                                </td>
                                <td>
                                    Visus : {{ $json_data['visus'] }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr style="margin-top: 0px; margin-bottom:0px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Condition</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $noooo = 1;
                            //cek array vision
                            $arr_vision = array($json_data['distant_vision'] ?? null, $json_data['near_vision']  ?? null ,$json_data['colour_vision']  ?? null , $json_data['any_organic_eye_disease']  ?? null);

                            $cek_arr_vision = in_array("on", $arr_vision);
                            @endphp
                            @if($cek_arr_vision)
                            <tr>
                                <td>{{ $noooo++; }} Vision</td>
                            </tr>
                            @endif
                            @if($json_data['distant_vision'] ?? null)
                            <tr>
                                <td style="padding-left:15px;">Distant Vision</td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['near_vision'] ?? null)
                            <tr>
                                <td style="padding-left:15px;">Near Vision</td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['colour_vision'] ?? null)
                            <tr>
                                <td style="padding-left:15px;">Color Vision</td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['any_organic_eye_disease'] ?? null)
                            <tr>
                                <td style="padding-left:15px;">Any Organic Eye Disease</td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['hearing'] ?? null)
                            <tr>
                                <td>{{ $noooo++; }}. Hearing </td>
                            </tr>
                            <tr>
                                <td style="padding-left:15px; text-align: justify;"><font style="font-size: 10px;">Unable to hear ordinary conversation at 2 m</font></td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif

                            @php
                            //cek array cardio
                            $arr_cardio = array($json_data['blood_pressure'] ?? null, $json_data['heart_disease'] ?? null, $json_data['varicose_veins'] ?? null);

                            $cek_arr_cardio = in_array("on", $arr_cardio);
                            @endphp
                            @if($cek_arr_cardio || $json_data['pulse'] || $json_data['systolic_diastolic'])
                            <tr>
                                <td>{{ $noooo++; }}. Cardiovascular System </td>
                            </tr>
                            @endif
                            @if($json_data['blood_pressure'] ?? null)
                            <tr>
                                <td style="padding-left:15px;">Blood Pressure</td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['systolic_diastolic'] ?? null)
                            <tr>
                                <td style="padding-left:30px;">Systolic/Diastolic</td>
                                <td style="text-align: right; padding-right:9px;">{{ $json_data['systolic_diastolic'] }} <b>mmHg</b></td>
                            </tr>
                            @endif
                            @if($json_data['pulse'] ?? null)
                            <tr>
                                <td style="padding-left:30px;">Pulse</td>
                                <td style="text-align: right; padding-right:9px;">{{ $json_data['pulse'] }} <b>x/minute</b></td>
                            </tr>
                            @endif
                            @if($json_data['heart_disease'] ?? null)
                            <tr>
                                <td style="padding-left:15px;">Heart Disease</td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['varicose_veins'] ?? null)
                            <tr>
                                <td style="padding-left:15px;">Varicose Veins</td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['respiratory_system'] ?? null)
                            <tr>
                                <td>{{ $noooo++; }}. Respiratory System </td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['skin_chronic'] ?? null)
                            <tr>
                                <td>{{ $noooo++; }}. Skin-Chronic </td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['abdomen'] ?? null)
                            <tr>
                                <td>{{ $noooo++; }}. Abdomen </td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['locomotor_neurogical'] ?? null)
                            <tr>
                                <td>{{ $noooo++; }}. Locomotor/Neurogical </td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['endocrine_disorders'] ?? null)
                            <tr>
                                <td>{{ $noooo++; }}. Endocrine disorders </td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif
                            @if($json_data['mental_state'] ?? null)
                            <tr>
                                <td>{{ $noooo++; }}. Mental State </td>
                                <td style="text-align:center">Yes/Abnormal</td>
                            </tr>
                            @endif

                            
                        </tbody>
                    </table>

                </td>
                <td style="width: 50%; vertical-align: top;">
                    {{-- LABORATORY TEST --}}
                    <table width="100%">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Name</th>
                                <th>Condition</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($json_data['laboratory_test'] ?? null)
                                @forelse($json_data['laboratory_test'] as $key_lt => $val_lt)
                                    @php
                                        $resss = DB::table('laboratory_test')->select('name_laboratory_test')->where([['id_laboratory_test','=', $json_data['laboratory_test'][$key_lt]],['type_laboratory_test','=','main']])->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $resss->name_laboratory_test }}</td>
                                        <td style="text-align:center">Yes/Abnormal</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">-</td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                    {{-- OTHER TEST --}}
                    <table width="100%">
                        <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                            <tr>
                                <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                                    OTHER TEST
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Name</th>
                                <th>Condition</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($json_data['other_test'] ?? null)
                                @forelse($json_data['other_test'] as $key_lt_other => $val_lt_other)
                                    @php
                                        $res_other = DB::table('laboratory_test')->select('name_laboratory_test')->where([['id_laboratory_test','=', $json_data['other_test'][$key_lt_other]],['type_laboratory_test','=','other']])->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $res_other->name_laboratory_test }}</td>
                                        <td style="text-align:center">Yes/Abnormal</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">-</td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                    {{-- REMARK --}}
                    <table width="100%">
                        <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                            <tr>
                                <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                                    REMARK
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="text-align:justify;">{{ $json_data['remark_health_screening_page_dua'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tbody>
        </table>

        {{-- PANEL DOCTOR DECLERATION --}}
        
        <table width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                        PANEL DOCTOR DECLERATION
                    </th>
                </tr>
            </thead>
        </table>
        <table width="100%" style="padding-left:5px; padding-right: 5px; font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-align:justify;">
            <tbody>
                <td>{{ $json_data['panel_doctor_declaration'] }}</td>
            </tbody>
        </table>

        {{-- ADVICE --}}
        
        <table width="100%">
            <thead style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;">
                <tr>
                    <th style="text-align:left; text-decoration: underline; background-color: #b5be83">
                        ADVICE
                    </th>
                </tr>
            </thead>
        </table>
        <table width="100%" style="padding-left:5px; padding-right: 5px; font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-align:justify;">
            <tbody>
                <td>{{ $json_data['advice_health_screening'] }}</td>
            </tbody>
        </table>
        
        <br>

        <table border="0" width="100%">
            <tr>
            <td style="width: 350px" rowspan="2"></td>
                <td style="text-align:center; vertical-align: middle; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                    Batam, {{ $tgl_ttd }}<br><br><br><br><br>
                </td>
            <tr>
                <td style="text-align:center; vertical-align: middle; font-style: italic;font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
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
        
        {{-------------------------- PEMBATAS PAGE 3 --------------------------}}

        <p style="page-break-before: always; margin-top: -80px;"></p>

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
                     
                        {{ $json_data_three['describe_abnormalities'][$Valdetail_physical->id_physical]; }}

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
                    <td style="padding-left: 5px; vertical-align: top; text-align: justify;">{{ $json_data_three['remark_health_screening_page_tiga'] }}</td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
            </tbody>
        </table> 

  
  </div>
</div>
</body>
</html>
<style type="text/css">
    .tdSatu{
      border: 0.1px solid grey ;
      border-collapse: collapse;
    }

    #MedHis {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #MedHis td, #MedHis th {
      border: 1px solid;
      padding: 2px;
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
