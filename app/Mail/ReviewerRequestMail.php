<?php
namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;


class ReviewerRequestMail extends Mailable
{
    use Queueable,SerializesModels;
    
    public function __construct(public User $user){}

    public function build():static{return $this->subject('Richiesta ruolo revisore')->view('emails.reviewer-request')->with(['user'=>$this->user,'approveUrl'=>URL::temporarySignedRoute('admin.approve',now()->addMinutes(60),['user'=>$this->user->id]),'rejectUrl'=>URL::temporarySignedRoute('admin.reject',now()->addMinutes(60),['user'=>$this->user->id]),]);}
}