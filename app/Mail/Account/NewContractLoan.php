<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContractLoan extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;
    public $status;

    /**
     * Create a new message instance.
     *
     * @param $loan
     * @param $status
     */
    public function __construct($loan, $status)
    {
        //
        $this->loan = $loan;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->status == 1) {
            return $this->view('emails.account.loan.waiting', [
                "loan" => $this->loan,
            ])->subject("Votre demande de pret N°" . $this->loan->reference);
        } elseif ($this->status == 2) {
            return $this->view('emails.account.loan.accepted', [
                "loan" => $this->loan,
            ])->subject("Votre demande de pret N°" . $this->loan->reference);
        } elseif ($this->status == 3) {
            return $this->view('emails.account.loan.declined', [
                "loan" => $this->loan,
            ])->subject("Votre demande de pret N°".$this->loan->reference);
        } elseif ($this->status == 4) {
            return $this->view('emails.account.loan.progress', [
                "loan" => $this->loan,
            ])->subject("Votre demande de pret N°".$this->loan->reference);
        } elseif($this->status == 5) {
            return $this->view('emails.account.loan.terminated', [
                "loan" => $this->loan,
            ])->subject("Votre demande de pret N°".$this->loan->reference);
        } else {
            return $this->view('emails.account.loan.error', [
                "loan" => $this->loan,
            ])->subject("Votre demande de pret N°".$this->loan->reference);
        }
    }
}
