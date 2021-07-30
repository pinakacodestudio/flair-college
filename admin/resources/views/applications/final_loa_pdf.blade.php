<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{!! 'Application #'.$students_application->application_no !!} - FINAL LOA</title>
    <style>
		.watermark{
			position:absolute;
			top:45%;
			left:36%;
			
		}
        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        .address {
            text-align: left;
            margin-top: 20px;
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
            font-weight: 500;
        }

        /*@page { margin: 20px auto; }*/

        header {
            padding: 10px 0;
        }

        #logo {
            float: left;
            margin-bottom: 10px;
            width: 50%;
        }

        #logo img {
            height: 75px;
        }


        h1 {
            color: #004080;
            font-size: 1.6em;
            line-height: 1.2em;
            margin: 0;
            text-align: center; /* new 27-02-21 */
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
            padding: 0px 5px;
            border: 1px solid #000;
            /*font-weight: bold;*/
        }

        table.letter_detail td {
            width: 50% !important;
            vertical-align: top;
            display: table-cell;
        }

        table.letter_detail td .key {
            font-weight: 700;
            line-height: 16px;
        }

        table.letter_detail td div {
            /*line-height: 1;*/
        }

        table.letter_detail td div:empty {
            height: 15px;
        }

        .float_left {
            /*float: left;*/
            display: inline-block;
            /*display: inline-flex;*/
            /*new*/
            vertical-align: top;
            /*margin-top: 6px;*/
        }

        /*.float_left {
            border-right: 1px solid;
            padding-top: 5px;
            !*margin-top: 5px;*!
        }

        .float_left:last-child {
            border-right: 0;
        }*/

        .border_right {
            border-right: 1px solid;
            /*margin-right: 5px;*/
            /*margin-top: 6px;*/
        }

        .width_10_p {
            width: 10% !important;
        }

        .width_20_p {
            width: 20% !important;
        }

        .width_30_p {
            width: 29% !important;
        }

        .width_40_p {
            width: 40% !important;
        }

        .width_50_p {
            width: 50% !important;
        }

        .width_60_p {
            width: 60% !important;
        }

        .width_70_p {
            width: 70% !important;
        }

        .underline {
            border-bottom: 1px solid #000;
            padding: 0 3px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .red {
            color: #c00000;
        }

        .page-break {
            page-break-after: always;
        }

        /* new 27-02-21 */
        .heading {
            padding: 3px;
            background-color: #004080;
            color: #fff;
            /*text-align: center;*/ /* 27-02-21 */
            font-weight: 600;
            border: 1px solid #004080;
        }

        @media print {
            .non-printable {
                display: none !important;
            } 
        }
    </style>
</head>
<body>
<main style="page-break-inside: avoid;" id="">
	<img id="loaimage" src="" />
	<div id="printable">
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
		<h1>Letter of Acceptance</h1>
		<h3 class="heading" style="margin: 5px 0 0 0;">
			PERSONAL INFORMATION
			<span style="float: right;">Date : {!! date('Y/m/d') !!}</span>
		</h3>
		<table class="letter_detail">
			<tbody>
			<tr>
				<td>
					<div class="key">Family Name</div>
					<div>{!! $students_application->last_name !!}</div>
				</td>
				<td>
					<div class="key">Given Name</div>
					<div>{!! $students_application->last_name !!}</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="key">Date of Birth</div>
					<div>{!! $students_application->dob ? $students_application->dob->format('Y/m/d') :'' !!}</div>
				</td>
				<td>
					<div class="key">Student ID Number</div>
					<div>{!! $student_admission->student_id_number !!}</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="key">Student's full mailing Address</div>
					<div>{!! $students_application->home_address !!}<br/>
						{!! $students_application->home_country !!}</div>
				</td>
				<td>
					<div class="key">Secondary Address</div>
					<div>{!! $students_application->secondary_address !!}<br/>
						{!! $students_application->secondary_city !!}
						{!! $students_application->secondary_province !!}</div>
				</td>
			</tr>
			</tbody>
		</table>


		<h3 class="heading" style="margin-bottom: 0;margin-top: 10px;">INSTITUTIONAL INFORMATION</h3>
		<table class="letter_detail">
			<tbody>
			<tr>
				<td>
					<div class="key">Full Name of institution</div>
					<div>{!! $college->name !!}</div>
				</td>
				<td>
					<div class="key">Designated learning institution number</div>
					<div>{!! $college->dli_number !!}</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="key">Address of institution{{--{!! $college->address !!}--}}</div>
				</td>
			</tr>

			{{--<tr>
				<td>
					<div style="display: block;">
						<div class="width_50_p float_left1 border_right" style="float: left;border-right: 1px solid;">
							<div class="key">P.O.BOX</div>
							<div>{!! $college->po_box !!}</div>
						</div>
						<div class="float_left">
							<div class="key">Street no.</div>
							<div>{!! $college->street_no !!}</div>
						</div>
					</div>
				</td>
				<td>
					<div style="float: left;">
						<div>{!! $college->street_name !!}</div>
						<div class="key">Street Name</div>
					</div>
				</td>
			</tr>--}}

			<tr>
				<td>
					<div>
						<div class="width_50_p float_left border_right">
							<div class="key">P.O.BOX</div>
							<div>{!! $college->po_box !!}</div>
						</div>
						<div class="float_left">
							<div class="key">Street no.</div>
							<div>{!! $college->street_no !!}</div>
						</div>
					</div>
				</td>
				<td>
					<div>
						<div class="key">Street Name</div>
						<div>{!! $college->street_name !!}</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div>
						<div class="width_50_p float_left border_right">
							<div class="key">City/Town</div>
							<div>{!! $college->city !!}</div>
						</div>
						<div class="float_left">
							<div class="key">Province/Territory</div>
							<div>{!! $college->province !!}</div>
						</div>
					</div>
				</td>
				<td>
					<div class="key">Postal Code</div>
					<div>{!! $college->postcode !!}</div>
				</td>
			</tr>
			<tr>
				<td>
					<div>
						<div class="width_50_p float_left border_right">
							<div class="key">Telephone number</div>
							<div>{!! $college->phone !!}</div>
						</div>
						<div class="float_left">
							<div class="key">Extension</div>
							<div>{!! $college->extension !!}</div>
						</div>
					</div>
				</td>
				<td>

					<div class="width_50_p float_left border_right">
						<div class="key">Fax number</div>
						<div>{!! $college->fax!!}</div>
					</div>
					<div class="float_left">
						<div class="key">Type of School/Institution</div>
						<div>{!! $college->institution_type !!}</div>
					</div>

				</td>
			</tr>
			<tr>
				<td>
					<div class="key">Website</div>
					<div>{!! $college->website !!}</div>
				</td>
				<td>
					<div class="key">Email</div>
					<div>{!! $college->email !!}</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="width_30_p float_left border_right">
						<div class="key">Name of contact</div>
						<div>{!! $staff1?$staff1->full_name:'' !!}</div>
					</div>
					<div class="width_30_p float_left border_right">
						<div class="key">Position</div>
						<div>{!! ($staff1?($staff_position[$staff1->position]):'') !!}</div>
					</div>
					<div class="width_30_p float_left border_right">
						<div class="key">Telephone number</div>
						<div>{!! $staff1?$staff1->mobile:'' !!}</div>
					</div>
					<div class="width_10_p float_left">
						<div class="key">Extension</div>
						<div>{!! $staff1?$staff1->extension:'' !!}</div>
					</div>
				</td>
			</tr>
			{{--<tr>
				<td colspan="2">
					<div class="width_30_p float_left border_right">
						<div class="key">Name of alternate contact</div>
						<div>{!! $staff2?$staff2->full_name:'' !!}</div>
					</div>
					<div class="width_30_p float_left border_right">
						<div class="key">Position</div>
						<div>{!! ($staff2?($staff_position[$staff2->position]):'') !!}</div>
					</div>
					<div class="width_30_p float_left border_right">
						<div class="key">Telephone number</div>
						<div>{!! $staff2?$staff2->mobile:'' !!}</div>
					</div>
					<div class="width_10_p float_left">
						<div class="key">Extension</div>
						<div>{!! $staff2?$staff2->extension:'' !!}</div>
					</div>
				</td>
			</tr>--}}

			</tbody>
		</table>

		<h3 class="heading" style="margin-bottom: 0;margin-top: 10px;">PROGRAM INFORMATION</h3>
		<table class="letter_detail">
			<tbody>
			<tr>
				<td>
					<div class="width_40_p float_left border_right">
						<div class="key">Academic status</div>
						<div>{!! $student_admission->academic_status !!}</div>
					</div>
					<div class="float_left">
						<div class="key">Hours of Instruction Per Week</div>
						<div>{!! $student_admission->hours_per_week !!}</div>
					</div>
				</td>
				<td>
					<div class="key">Field/Program of Study</div>
					<div>{!! $program->name !!}</div>
				</td>
			</tr>

			<tr>
				<td>
					<div class="key">Level of Study</div>
					<div>{!! $student_admission->level_of_study !!}</div>
				</td>
				<td>
					<div class="key">Type of training Program</div>
					<div>{!! $student_admission->type_of_program !!}</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="key">Exchange Program</div>
					<div>{!! $student_admission->level_of_study !!}</div>
				</td>
				<td>
					<div class="key">Estimated tuition fees for the first academic year</div>
					<div>
						<div class="width_40_p border_right float_left" style="padding-bottom: 3px;">
							<span class="underline">${!! $student_admission->first_year_fees !!}</span>
						</div>
						<div class="float_left">
							<strong>Feed Prepaid:</strong> {!! ($student_admission->fees_prepaid?'Yes':'No') !!}
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="key">Scholarship/Teaching assistantship/Other
						financial aid
					</div>
					<div>{!! ($student_admission->is_scholarship?('Yes : '.$student_admission->scholarship):'No') !!}</div>
				</td>
				<td>
					<div class="key">Internship/Work practicum</div>
					<div>{!! ($student_admission->is_internship?'Yes':'No') !!}</div>
					@if($student_admission->is_internship)
						<div><strong>Length:</strong> {!! $student_admission->internship_length !!}</div>
						<div><strong>Field of work:</strong> {!! $student_admission->internship_work !!}</div>
					@endif
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="key">Conditions of acceptance specified as clearly as possible</div>
					<div>{!! $student_admission->conditions_of_acceptance !!}</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="key">Length of Program</div>
					<div>
						<div class="width_30_p float_left text-right" style="margin-right: 3px;margin-top: 0;"><strong>Start
								Date:</strong></div>
						@if($student_admission->start_at)
							{!! $student_admission->start_at->format('Y/m/d') !!}
						@endif
					</div>
					<div>
						<div class="width_30_p float_left text-right" style="margin-right: 3px;margin-top: 0;"><strong>Completion
								Date:</strong></div>
						@if($student_admission->completion_at)
							{!! $student_admission->completion_at->format('Y/m/d') !!}
						@endif
					</div>
				</td>
				<td>
					<div class="key">Expiration of latter of acceptance</div>
					<div>
						@if($student_admission->expiration_at)
							{!! $student_admission->expiration_at->format('Y/m/d') !!}
						@endif
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="key">Other relevant information</div>
					<div>{!! $student_admission->other_information !!}</div>
				</td>
			</tr>
			</tbody>
		</table>
		<div>
			<div class="clearfix" style="padding-top: 15px;">
				<div class="width_50_p float_left text-right">
					<strong>Signature of institutions representative: </strong>
				</div>
				<div class="width_40_p float_left"
					 style="border-bottom: 1px solid;min-height: 15px;margin-left: 5px;">&nbsp;
					@if($college_campus && $college_campus->staff && $college_campus->staff->signature_filename)
						<img src="{!! route('storage_signature',['filename'=>$college_campus->staff->signature_filename]); !!}" style="width: 100px;max-height: 50px;"/>
					@endif
				</div>
			</div>
			<div class="clearfix" style="padding-top: 10px;">
				<div class="width_50_p float_left text-right">
					<strong>Printed name of institutions representative: </strong>
				</div>
				<div class="width_40_p float_left"
					 style="border-bottom: 1px solid;min-height: 15px;margin-left: 5px;">
					@if($college_campus)
						{!! $college_campus->staff?$college_campus->staff->full_name.', '.$staff_position[$college_campus->staff->position]:'' !!}
					@else
						{!! $staff1?($staff1->full_name.', '.$staff_position[$staff1->position]):'' !!}
					@endif
				</div>
			</div>
		</div>
		<img src="{!! asset('assets/img/watermark_logo.png') !!}" alt="LOGO" class="watermark">       
	</div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script>

	$('document').ready(function(){  
		//https://www.techiesbadi.in/2016/09/how-to-convert-html-content-into-image.html
		html2canvas($("#printable"), {  
			onrendered: function(canvas) {  
				var imgsrc = canvas.toDataURL("image/png");  
				$("#printable").html('');  
				console.log(imgsrc);  
				//$('#loaimage').css('background-image', 'url(' + imgsrc + ')');
				$('#loaimage').attr('src', imgsrc );
			}  
		});  
	});  

</script>
</body>
</html>
