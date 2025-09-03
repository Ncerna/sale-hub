<?php
namespace Application\DTOs;

class RequestQuery
{
    public int $page;
    public int $size;
    public ?string $search;

    public function __construct(int $page = 1, int $size = 10, ?string $search = null)
    {
        $this->page = $page;
        $this->size = $size;
        $this->search = $search;
    }

    public static function fromRequest(\Illuminate\Http\Request $request): self
    {
        return new self(
            page: (int) $request->input('page', 1),
            size: (int) $request->input('size', 10),
            search: $request->input('search')
        );
    }
}
