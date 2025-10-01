<?php

namespace ChicoRei\Packages\Correios\Response;

use ChicoRei\Packages\Correios\CorreiosObject;
use ChicoRei\Packages\Correios\Model\Pagination;
use ChicoRei\Packages\Correios\Model\QueryPrePostagem;
use InvalidArgumentException;

class QueryPrePostagemResponse extends CorreiosObject
{
    /**
     * Pre Postagens encontradas.
     *
     * @var QueryPrePostagem[]|null
     */
    public ?array $itens = null;

    /**
     * Paginação.
     */
    public ?Pagination $page = null;

    public function getItens(): ?array
    {
        return $this->itens;
    }

    /**
     * @param QueryPrePostagem[]|null $itens
     * @return QueryPrePostagemResponse
     */
    public function setItens(?array $itens): QueryPrePostagemResponse
    {
        if (is_array($itens)) {
            $this->itens = [];

            foreach ($itens as $item) {
                $this->addItem($item);
            }
        } else {
            $this->itens = null;
        }

        return $this;
    }

    /**
     * @param QueryPrePostagem|array $item
     * @return QueryPrePostagemResponse
     */
    public function addItem($item): QueryPrePostagemResponse
    {
        if (! is_array($item) && ! $item instanceof QueryPrePostagem) {
            throw new InvalidArgumentException('The argument must be an instance of QueryPrePostagem or an array');
        }

        if (!isset($this->itens)) {
            $this->itens = [];
        }

        $this->itens[] = QueryPrePostagem::create($item);

        return $this;
    }

    public function getPage(): ?Pagination
    {
        return $this->page;
    }

    /**
     * @param Pagination|array|null $page
     * @return $this
     */
    public function setPage($page): QueryPrePostagemResponse
    {
        $this->page = is_null($page) ? null : Pagination::create($page);
        return $this;
    }

    public function toArray(): array
    {
        return [
            'itens' => $this->getItens()
                ? array_map(function (QueryPrePostagem $prePostagem) {
                    return $prePostagem->toArray();
                }, $this->getItens())
                : null,
            'page' => $this->getPage() ? $this->getPage()->toArray() : null,
        ];
    }
}
