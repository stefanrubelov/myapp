<?php

namespace App\Livewire\Components\SidebarMenu;

class MenuItem
{
    private string $title;
    private ?string $route = null;
    private ?string $url = null;
    private ?string $icon = null;
    private array $permissions = [];
    private string $id;
    private string $type = 'item';

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->id = str()->slug($title);
    }

    public static function make(string $title): self
    {
        return new static($title);
    }

    public function route(string $name, array $params = []): self
    {
        $this->route = $name;
        $this->url = route($name, $params);

        return $this;
    }

    public function url(string $url): self
    {
        $this->url = $url;
        $this->route = null;

        return $this;
    }

    public function icon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function permissions(array|string $permissions): self
    {
        $this->permissions = is_array($permissions) ? $permissions : [$permissions];

        return $this;
    }

    public function isActive(): bool
    {
        $currentUrl = request()->url();

        return $this->url === $currentUrl;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'route' => $this->route,
            'url' => $this->url,
            'icon' => $this->icon,
            'permissions' => $this->permissions,
            'isActive' => $this->isActive(),
        ];
    }
}
