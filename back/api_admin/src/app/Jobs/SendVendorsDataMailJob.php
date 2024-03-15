<?php

namespace App\Jobs;

use App\Notifications\SendVendorsDataNotification;
use App\Notifications\SendVendorsStatusNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendVendorsDataMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $vendor_user;
    private $data;
    public function __construct($vendor_user, $data)
    {
        $this->data = $data;
        $this->vendor_user = $vendor_user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->vendor_user != null)
            $this->vendor_user->notify(new SendVendorsDataNotification($this->data));
        else
            Notification::route('mail', $this->data['email'])->notify(new SendVendorsStatusNotification());
    }
}
