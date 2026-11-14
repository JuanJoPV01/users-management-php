<?php

declare(strict_types=1);

final class PartidoPoliticoPage
{
    private array $items;
    private int $total;
    private int $page;
    private int $limit;

    public function __construct(array $items, int $total, int $page, int $limit)
    {
        $this->items = $items;
        $this->total = max(0, $total);
        $this->page = max(1, $page);
        $this->limit = max(1, $limit);
    }

    public function items(): array
    {
        return $this->items;
    }

    public function total(): int
    {
        return $this->total;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function totalPages(): int
    {
        if ($this->total === 0) {
            return 0;
        }

        return (int) ceil($this->total / $this->limit);
    }

    public function hasPreviousPage(): bool
    {
        return $this->page > 1 && $this->totalPages() > 0;
    }

    public function hasNextPage(): bool
    {
        return $this->page < $this->totalPages();
    }
}
