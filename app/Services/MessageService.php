<?php

namespace App\Services;

use App\Models\Event;
use App\Models\GuestGroup;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;

class MessageService
{
    protected $whatsappApiKey;
    protected $smsApiKey;

    public function __construct()
    {
        $this->whatsappApiKey = config('services.whatsapp.api_key');
        $this->smsApiKey = config('services.sms.api_key');
    }

    public function sendInvitation(Event $event, GuestGroup $guestGroup)
    {
        $message = $this->generateInvitationMessage($event);
        $imageUrl = url('storage/' . $event->invitation->card_path);

        // Send WhatsApp message
        $this->sendWhatsAppMessage($guestGroup->mobile_number, $message, $imageUrl);

        // Send SMS as a fallback
        $this->sendSMS($guestGroup->mobile_number, $message);
    }

    protected function generateInvitationMessage(Event $event)
    {
        return "You're invited to {$event->title}!\n"
            . "Date: {$event->date}\n"
            . "Location: {$event->location}\n"
            . "Please confirm your attendance: " . route('guest.confirm.page', $event->id);
    }

    protected function sendWhatsAppMessage($to, $message, $imageUrl = null)
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_WHATSAPP_PHONE_NUMBER');

        $client = new Client($accountSid, $authToken);

        if ($imageUrl) {
            $mediaUrl = $client->messages
                ->create('whatsapp:'.$to, [
                    'from' => 'whatsapp:' . $twilioPhoneNumber,
                    'body' => $message,
                    'mediaUrl' => $imageUrl,
                ])
                ->mediaUrl;
        } else {
            $client->messages
                ->create('whatsapp:'.$to, [
                    'from' => 'whatsapp:' . $twilioPhoneNumber,
                    'body' => $message,
                ]);
        }
    }

    protected function sendSMS($to, $message)
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
        $client = new Client($accountSid, $authToken);

        $client->messages
            ->create($to, [
                'from' => $twilioPhoneNumber,
                'body' => $message,
            ]);
    }
}