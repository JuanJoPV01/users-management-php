<?php

declare(strict_types=1);

final class GetAllPartidosPoliticosQuery
{
    private const MAX_LIMIT = 100;

    private string $search;
    private int $page;
    private int $limit;

    public function __construct(?string $search = null, int $page = 1, int $limit = 10)
    {
        $this->search = $search !== null ? trim($search) : '';
        $this->page = $page > 0 ? $page : 1;
        $this->limit = $limit > 0 ? min($limit, self::MAX_LIMIT) : 10;
    }

    public function getSearch(): string
    {
        return $this->search;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }
}
