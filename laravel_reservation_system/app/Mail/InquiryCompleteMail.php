<?php
namespace App\Mail;
use Illuminate\Mail\Mailable;

class InquiryCompleteMail extends Mailable
{
    public $name;
    public $inquiry_content;

    public function __construct($name,$inquiry_content)
    {
        $this->name = $name;
        $this->inquiry_content = $inquiry_content;
    }

    public function build()
    {
        return $this->view('emails.inquiry_complete')
            ->subject('HOTEL LARAVEL お問い合わせ完了メール');
    }
}