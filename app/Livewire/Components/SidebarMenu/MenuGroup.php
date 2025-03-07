<?php

namespace App\Livewire\Components\SidebarMenu;

class MenuGroup
{
    private string $title;
    private ?string $icon = null;
    private array $items = [];
    private bool $isCollapsible;
    private bool $isCollapsed;
    private array $permissions = [];
    private string $id;
    private string $type = 'group';

    public function __construct(string $title, bool $isCollapsible = true, bool $isCollapsed = true)
    {
        $this->title = $title;
        $this->isCollapsible = $isCollapsible;
        $this->isCollapsed = $isCollapsed;
        $this->id = str()->slug($title);
    }

    public static function make(string $title): self
    {
        return new static($title);
    }

    public function icon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }


    /**
     * @param array<MenuItem> $items
     * @return $this
     */
    public function items(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function permissions(array|string $permissions): self
    {
        $this->permissions = is_array($permissions) ? $permissions : [$permissions];
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function hasActiveItems(): bool
    {
        return array_any($this->items, fn($item) => $item->isActive());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'icon' => $this->icon,
            'items' => array_map(fn(MenuItem $item) => $item->toArray(), $this->items),
            'isCollapsible' => $this->isCollapsible,
            'isCollapsed' => $this->isCollapsed,
            'permissions' => $this->permissions,
            'hasActiveItems' => $this->hasActiveItems(),
        ];
    }
}
