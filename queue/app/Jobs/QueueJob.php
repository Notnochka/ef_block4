<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class QueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $message
    ) {}

    public function handle(): void
    {
        Log::info("Обработан job: {$this->message} " . now());
        
        file_put_contents(
            storage_path('logs/queue.log'), 
            "[" . now() . "] {$this->message}\n", 
            FILE_APPEND
        );
    }
}
