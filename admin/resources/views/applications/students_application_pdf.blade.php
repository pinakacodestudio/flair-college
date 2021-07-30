<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{!! 'Application #'.$students_application->application_no !!}</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        .address {
            text-align: left;
            margin-top: 30px;
            width: 35%;
            float: right;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 19cm;
            height: 26cm;
            margin: 0 auto;
            color: black;
            background: #FFFFFF;
            font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;

            line-height: 1.5;
            font-weight: 600;
        }

        header {
            padding: 10px 0;
        }

        #logo {
            float: left;
            margin-bottom: 10px;
            width: 50%;
        }

        #logo img {
            height: 80px;
        }

        h1 {
            line-height: 1.4;
            font-weight: bold;
            margin: 0;
        }

        h2 {
            color: #004080;
            font-size: 1.4em;
            line-height: 1.4em;
            font-weight: bold;
            margin: 10px 10px 20px 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            /*margin-bottom: 20px;*/
        }

        /*table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }*/


        table th {
            padding: 5px 5px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            padding: 1px 5px;
            border: 1px solid #000;
            /*font-weight: bold;*/
        }

        table.letter_detail td.key {
            width: 20%;
        }

        table.letter_detail td:not(.key) {
            font-weight: 600;
        }

        footer {
            /*color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;*/
        }

        .p10 {
            padding: 0 5px;
        }

        .pt20 {
            padding-top: 20px!important;
        }

        .br {
            height: 1px;
            border-top: 1px solid #000;
            margin: 5px 0;
        }

        .block {
            margin-top: 20px;
            border: 1px solid #000;
        }

        .heading {
            padding: 3px;
            background-color: #004080;
            color: #fff;
            text-align: center;
            font-weight: 600;
        }

        .table_view {
            width: 100%;
        }

        .table_view table td.table_view_key {
            width: 30%;
            border-left: 0;
        }

        .table_view table td:not(.table_view_key) {
            font-weight: 600;
            border-right: 0;
        }

        .block ol, .block ul {
            margin: 5px 0;
        }

        .block .underline {
            border-bottom: 1px solid #000;
            padding: 0 3px;
        }

        .bank {
            margin-top: 20px;
        }


        .bank h1 {
            margin: 20px 0;
        }

        .bank .info {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .red {
            color: #c00000;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<main>
    <div class="clearfix">
        <div id="logo">
            <img src="{!! asset('assets/img/logo-wide-1.png') !!}" alt="LOGO">
        </div>
        <div class="address">
            <div style="text-align: right;font-size: 18px;">Application #{!! $students_application->application_no !!}</div>
        </div>
    </div>
    <h2>STUDENTS APPLICATION</h2>
    <table class="letter_detail">
        <tbody>
        <tr>
            <td class="key">Date</td>
            <td colspan="3">{!! date('Y-m-d') !!}</td>
        </tr>
        <tr>
            <td class="key">Name</td>
            <td colspan="3">{!! $students_application->full_name !!}</td>
        </tr>
        <tr>
            <td class="key">DOB</td>
            <td colspan="3">{!! $students_application->dob ? $students_application->dob->format('Y-m-d') :'' !!}</td>
        </tr>
        <tr>
            <td class="key">Address</td>
            <td colspan="3">{!! $students_application->home_address !!}</td>
        </tr>
        <tr>
            <td class="key">City</td>
            <td>{!! $students_application->secondary_city !!}</td>
            <td class="key">Province / State</td>
            <td>{!! $students_application->secondary_postcode !!}</td>
        </tr>
        <tr>
            <td class="key">Country</td>
            <td>{!! $students_application->home_country !!}</td>
            <td class="key">Postal Code</td>
            <td>{!! $students_application->home_postcode !!}</td>
        </tr>
        </tbody>
    </table>

    <div class="block">

        <div class="heading">PROGRAM INFORMATION</div>
        <div class="table_view">
            <table>
                <tbody>
                <tr>
                    <td class="table_view_key">Selected Program/s</td>
                    <td>{!! $students_application->home_address !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Selected Intake/s</td>
                    <td>{!! $students_application->home_address !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="heading">AGENT INFORMATION</div>
        <div class="table_view">
            <table>
                <tbody>
                <tr>
                    <td class="table_view_key">Agent Name / Agent Company Name</td>
                    <td>{!! $students_application->agent_name !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="heading">INSTITUTIONAL INFORMATION</div>
        <div class="p10">
            <strong>Flair College of Management and Technology (FCMT)</strong> is registered by the Ministry of
            Advanced Education and Skills Development and listed on Service Ontario as a Private Career
            College in good standing and is a Designated Learning Institution <strong>(DLI# {!! $college->dli_number !!}
                ).</strong>
        </div>

    </div>

</main>
</body>
</html>