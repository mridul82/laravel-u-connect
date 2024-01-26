<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

use App\Models\Teacher;
use App\Models\TeacherProfile;

class RegistrationTeacher extends Mailable
{

    use Queueable, SerializesModels;

    public Teacher $user;
    public TeacherProfile $profile;
   // public array $attachments;
   public array $localAttachments = [];

    /**
     * Create a new message instance.
     */

    public function __construct(
        Teacher $user,
        TeacherProfile $profile,
        array $localAttachments
    )
    {
        //
        $this->user = $user;
        $this->profile = $profile;
        $this->localAttachments = $localAttachments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('urja.connect@findtutor.tech', 'Urja Connect'),
            subject: 'Welcome to Urja Connect!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.teacher_registration',
            with: [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'register_id' => $this->profile->register_id,

            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->localAttachments['file1']),
            Attachment::fromPath($this->localAttachments['file2']),
            Attachment::fromPath($this->localAttachments['file3']),
        ];
    }
}
