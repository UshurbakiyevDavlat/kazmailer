<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\EmailLog;

class WebhookController extends Controller
{
    /**
     * Handle webhook events from SendGrid.
     */
    public function handleWebhook(Request $request): JsonResponse
    {
        Log::info('SendGrid Event appereance', ['data' => $request->all()]);
        $events = $request->all();

        foreach ($events as $event) {
            Log::info('SendGrid Event', $event);

            // Проверяем, если в событии есть custom_args
            if (isset($event['campaign_id'])) {
                switch ($event['event']) {
                    case 'delivered':
                        $this->logEvent($event, 'delivered');
                        break;

                    case 'open':
                        $this->logEvent($event, 'opened');
                        break;

                    case 'click':
                        $this->logEvent($event, 'clicked');
                        break;

                    case 'bounce':
                        $this->logEvent($event, 'bounced');
                        break;

                    case 'unsubscribe':
                        $this->logEvent($event, 'unsubscribed');
                        break;

                    default:
                        Log::info('Unhandled SendGrid event', $event);
                        break;
                }
            } else {
                Log::warning('Missing custom_args in SendGrid event', $event);
            }

        }

        return response()->json(['message' => 'Webhook received']);
    }

    /**
     * Log email event to the database.
     */
    protected function logEvent($event, $status): void
    {
        EmailLog::updateOrCreate(
            [
                'campaign_id' => $event['campaign_id'],
                'email' => $event['email'],
            ],
            [
                'status' => $status,
                'event' => $event['event'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
