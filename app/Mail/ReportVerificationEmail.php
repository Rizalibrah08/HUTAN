<?php
namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $verificationUrl;

    public function __construct(Report $report)
    {
        $this->report = $report;
        $this->verificationUrl = route('lapor.verify', $report->verification_token);
    }

    public function build()
    {
        return $this->subject('Verifikasi Email Laporan Lingkungan - ' . $this->report->title)
                    ->view('emails.report-verification')
                    ->with([
                        'report' => $this->report,
                        'verificationUrl' => $this->verificationUrl,
                        'currentYear' => date('Y')
                    ]);
    }
}