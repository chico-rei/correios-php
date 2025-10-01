<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;

class Pagination extends CorreiosObject
{
    public ?int $size = null;

    public ?int $numberElements = null;

    public ?int $totalPages = null;

    public ?int $number = null;

    public ?int $count = null;

    public ?bool $next = null;

    public ?bool $previous = null;

    public ?bool $first = null;

    public ?bool $last= null;

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): Pagination
    {
        $this->size = $size;
        return $this;
    }

    public function getNumberElements(): ?int
    {
        return $this->numberElements;
    }

    public function setNumberElements(?int $numberElements): Pagination
    {
        $this->numberElements = $numberElements;
        return $this;
    }

    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    public function setTotalPages(?int $totalPages): Pagination
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): Pagination
    {
        $this->number = $number;
        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): Pagination
    {
        $this->count = $count;
        return $this;
    }

    public function getNext(): ?bool
    {
        return $this->next;
    }

    public function setNext(?bool $next): Pagination
    {
        $this->next = $next;
        return $this;
    }

    public function getPrevious(): ?bool
    {
        return $this->previous;
    }

    public function setPrevious(?bool $previous): Pagination
    {
        $this->previous = $previous;
        return $this;
    }

    public function getFirst(): ?bool
    {
        return $this->first;
    }

    public function setFirst(?bool $first): Pagination
    {
        $this->first = $first;
        return $this;
    }

    public function getLast(): ?bool
    {
        return $this->last;
    }

    public function setLast(?bool $last): Pagination
    {
        $this->last = $last;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'size' => $this->getSize(),
            'numberElements' => $this->getNumberElements(),
            'totalPages' => $this->getTotalPages(),
            'number' => $this->getNumber(),
            'count' => $this->getCount(),
            'next' => $this->getNext(),
            'previous' => $this->getPrevious(),
            'first' => $this->getFirst(),
            'last' => $this->getLast(),
        ];
    }
}
