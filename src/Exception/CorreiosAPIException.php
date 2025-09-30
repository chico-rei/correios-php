<?php

namespace ChicoRei\Packages\Correios\Exception;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class CorreiosAPIException extends \Exception
{

    private ?Request $request;

    private ?Response $response;

    /**
     * CorreiosAPIException constructor.
     */
    public function __construct(
        string $message = '',
        string $code = '0',
        ?Request $request = null,
        ?Response $response = null
    ) {
        parent::__construct($message);

        $this->code = $code;
        $this->request = $request;
        $this->response = $response;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }
}
