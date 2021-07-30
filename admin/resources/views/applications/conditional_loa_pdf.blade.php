<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{!! 'Application #'.$students_application->application_no !!} - CONDITIONAL LOA</title>
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
            <div>{!! $college->address !!}</div>
            <div><strong>Phone:</strong> {!! $college->phone !!}</div>
            <div><strong>Email:</strong> {!! $college->email !!}</div>
        </div>
    </div>
    <h2>CONDITIONAL LETTER OF ACCEPTANCE</h2>
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
        <div class="p10">Dear <strong class="underline">{!! $students_application->full_name !!}</strong></div>
        <div class="p10">
            Congratulations! Based on the assessment of your application, we are pleased to offer you the training
            program at our college. Please see the program details below:
        </div>
        <div class="heading">PROGRAM INFORMATION</div>
        <div class="table_view">
            <table>
                <tbody>
                <tr>
                    <td class="table_view_key">Program Name</td>
                    <td>{!! $program->name !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Level of Study</td>
                    <td>{!! $student_admission->level_of_study !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Type of Program</td>
                    <td>{!! $student_admission->type_of_program !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Academic Status</td>
                    <td>{!! $student_admission->academic_status !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Hours of Instruction Per Week</td>
                    <td>{!! $student_admission->hours_per_week !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Program Start Date</td>
                    <td>{!! $student_admission->start_at->format('Y-m-d') !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Expected Completion Date</td>
                    <td>{!! $student_admission->completion_at->format('Y-m-d') !!}</td>
                </tr>
                <tr>
                    <td class="table_view_key">Program Duration</td>
                    <td>
                        @if($program->program_duration_weeks != '')
                            {!! $program->program_duration_weeks . ' Week/s' !!}
                        @elseif($program->program_duration_years != '')
                            {!! $program->program_duration_years . ' Year/s' !!}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="table_view_key">Total Fees (All Fees in CAD)</td>
                    <td>{!! number_format($program->total_fees,0) !!}</td>
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
        <div class="heading">FCMT EDGE PROGRAM</div>
        <div class="p10">
            After receiving the study permit upon arrival in Canada, it is required to attend a 4 weeks
            Preparation program, <strong>The FCMT EDGE</strong>. This program is specifically designed for international
            students
            helping them to start their Canadian educational journey. The cost of this program is
            ${!! number_format($program->total_fees,0) !!} CAD
            which is already included in the program fees. However, this amount is non-refundable in case the
            student changes mind and does not wish to commence the main program of study.
        </div>
        <div class="br"></div>
        <div class="p10">
            Please be reminded that you are required to have a valid <strong>Study permit and Medical Insurance</strong>
            to attend
            this program. The charges of Medical Insurance are <strong>not included</strong> in the program fees.
        </div>
        <div class="br"></div>
        <div class="p10">
            To proceed with the enrolment process, you are required to complete the following:
            <ol>
                <li>Submit fee deposit via Wire Transfer. Please find fee payment details in the next section.</li>
                <li>Please read the Declaration section carefully and sign. Once signed, this complete document is
                    to be scanned and submitted to FCMT. Please note that your signatures must match with those
                    on your Passport and must be made in the presence of a witness.
                </li>
            </ol>
        </div>
    </div>

    <div class="page-break"></div>
    <div class="clearfix">
        <div id="logo">
            <img src="{!! asset('assets/img/logo-wide-1.png') !!}" alt="LOGO">
        </div>
        <div class="address">
            <div>{!! $college->address !!}</div>
            <div><strong>Phone:</strong> {!! $college->phone !!}</div>
            <div><strong>Email:</strong> {!! $college->email !!}</div>
        </div>
    </div>

    <div class="block">
        <div class="heading">DECLARATION</div>
        <div class="p10">
            I, <strong class="underline">{!! $students_application->full_name !!}</strong> acknowledge receiving the
            enrollment information and
            conditions of Flair College, Canada:
            <ul>
                <li>
                    The program I am enrolled in is, at present, not eligible for the Post Graduate Work Permit
                    following the completion of studies.
                </li>
                <li>The primary purpose of travel to Canada is to study and not obtaining a Work permit.</li>
                <li>
                    I have done my due diligence on Flair College of Management and Technology. I am fully aware
                    of the college location. Before travel, I will arrange my accommodation accordingly.
                </li>
                <li>
                    I am 18 years of age or over and take full responsibility of my decisions. Upon arrival in Canada
                    on the study permit, I will solely communicate with the college and will not be represented by a
                    relative, guardian or friend.
                </li>
                <li>
                    I acknowledge that FCMT has limited seats in the intake I have applied for and I am fully
                    committed to completing the course. In case I decide not to continue the program, I
                    acknowledge that the Fees for the introductory program, FCMT Edge is not refundable.
                </li>
                <li>
                    In case of refusal of study visa, the student is entitled of full refund of the received tuition fee
                    except the administration fee of $300.
                </li>
            </ul>
        </div>
        <div class="p10">
            I declare that I have read, understood and agree with the above information.
        </div>
        <div class="p10 pt20">
            Applicant Signature: _________________________________________________________ Date: _____________________
        </div>
        <div class="p10 pt20">
            Witness Signature: __________________________________________________________ Date: _____________________
        </div>
        <div class="br"></div>
        <div class="p10 text-center">
            For questions / queries related to enrollment, please contact our office at<br/>
            {!! $college->email !!} or call us at {!! $college->phone !!} during the office hours.
        </div>
        <div class="br"></div>
        <div class="p10">
            Sincerely,
        </div>
        <div class="br"></div>
        <div class="p10" style="height: 50px;">

        </div>
        <div class="br"></div>
        <div class="p10">
            {!! $auth_user->full_name !!} | Admission Counsellor | Flair College of Management and Technology
        </div>
    </div>

    <div class="page-break"></div>
    <div class="clearfix">
        <div id="logo">
            <img src="{!! asset('assets/img/logo-wide-1.png') !!}" alt="LOGO">
        </div>
        <div class="address">
            <div>{!! $college->address !!}</div>
            <div><strong>Phone:</strong> {!! $college->phone !!}</div>
            <div><strong>Email:</strong> {!! $college->email !!}</div>
        </div>
    </div>

    <div class="block_ bank">
        <div class="heading">FCMT BANK INFORMATION</div>
        <div class="p10">
            <h1 class="text-center red"><u>Wire Transfer Information:</u></h1>
            <div class="info">
                <div>Bank Name: TD Canada Trust</div>
                <div>Institution No # 004</div>
                <div>Transit # 02372</div>
                <div>Bank Draft Information:</div>
                <div>Bank Draft payable to</div>
                <div>“Flair College of Management and Technology”</div>
                <div>Account # 5218273</div>
                <div>Account Name: Flair College of Management and Technology</div>
                <div>Routing No - 026009593</div>
                <br/>
                <div>Swift Code in CAD is TDOMCATTTOR</div>
            </div>
            <h1 class="text-center"><u>Bank Address:</u></h1>
            <div class="info">
                <div>TD Canada Trust #0237</div>
                <div>1900 King St E,</div>
                <div>Hamilton, Ontario</div>
                <div>L8K1W1</div>
            </div>
            <h1 class="text-center red"><u>Bank Draft Information:</u></h1>
            <div class="info">
                <div>Bank Draft payable to</div>
                <div>"Flair College of Management and Technology"</div>
            </div>
        </div>
    </div>
</main>
</body>
</html>