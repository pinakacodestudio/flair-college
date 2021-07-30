<?php

namespace App\Mail;

use App\Models\StudentsApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $students_application;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(StudentsApplication $students_application, $pdf)
    {
        $this->students_application = $students_application;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $filename = 'Students Application #' . $this->students_application->application_no . '.pdf';
        return $this->view('emails.students_application_success')
            ->subject('Your application successfully register with us - ' . config('app.name'))
            ->attachData($this->pdf->output(), $filename, [
                'mime' => 'application/pdf',
            ]);
    }
}
