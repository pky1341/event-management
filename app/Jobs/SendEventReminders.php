<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Event;
use App\Services\MessageService;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminder;

class SendEventReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    /**
     * Create a new job instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(MessageService $messageService)
    {
        foreach ($this->event->guestGroups as $guestGroup) {
            if ($guestGroup->confirmation_status === 'attending') {
                $message = $this->generateReminderMessage();
                $messageService->sendWhatsAppMessage($guestGroup->mobile_number, $message);
                $messageService->sendSMS($guestGroup->mobile_number, $message);
            }
        }
    }
    protected function generateReminderMessage()
    {
        return "Reminder: You have an upcoming event '{$this->event->title}' on {$this->event->date}. " .
                "We look forward to seeing you there!";
    }
}
