<?php
namespace App\Mail;
use Illuminate\Mail\Mailable;

class reservationCompleteMail extends Mailable
{
    public $name;
    public $date;

    public function __construct($name,$date)
    {
        $this->name = $name;
        $this->date = $date;
    }

    public function build()
    {
        return $this->view('emails.reservation_complete')
            ->subject('HOTEL LARAVEL 予約完了メール');
    }
}