<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class SimpleNotification extends Component
{
    public array $notifications = [];

    public const int TYPE_SUCCESS = 0;

    public const int TYPE_ALERT = 1;

    public const int TYPE_INFO = 2;

    public const int DEFAULT_TIMEOUT = 3000;

    protected $listeners = [
        'sendNotification',
    ];

    public function render(): View
    {
        return view('livewire.components.simple-notification');
    }

    public function sendNotification(string $title = '', string $message = '', int $type = 0, int $timeout = self::DEFAULT_TIMEOUT): void
    {
        $notification = [
            'id' => uniqid(),
            'title' => $title ?? '',
            'message' => $message ?? '',
            'type' => $type ?? 0,
            'show' => true,
            'border' => $this->getBorder($type ?? 0),
            'timeout' => $timeout ?? self::DEFAULT_TIMEOUT,
        ];

        array_unshift($this->notifications, $notification);

        $this->notifications = array_slice($this->notifications, 0, 5);
    }

    public function remove($notificationId): void
    {
        $this->notifications = array_filter($this->notifications, function ($notification) use ($notificationId) {
            return $notification['id'] !== $notificationId;
        });
    }

    private function getBorder(int $type): string
    {
        return match ($type) {
            self::TYPE_ALERT => 'border-l border-l-8 border-red-500',
            self::TYPE_INFO => 'border-l border-l-8 border-yellow-500',
            default => 'border-l border-l-8 border-green-500',
        };
    }
}
