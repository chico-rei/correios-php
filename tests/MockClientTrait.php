<?php

namespace ChicoRei\Packages\Correios\Tests;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Account;
use ChicoRei\Packages\Correios\Cache\ArrayCache;
use ChicoRei\Packages\Correios\Client;
use ChicoRei\Packages\Correios\Model\Token;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Psr\SimpleCache\CacheInterface;

/**
 * Helpers to build a Correios Client backed by a Guzzle MockHandler.
 *
 * A mock handler can be injected because the Client merges the caller
 * supplied guzzle options before its own overrides, and never overrides
 * the "handler" option.
 */
trait MockClientTrait
{
    /**
     * Build a Client whose Guzzle instance replays the queued responses.
     *
     * @param array $responses Queue of Response/Exception objects to replay.
     * @param array|null $history Filled with the transactions performed.
     */
    protected function makeMockClient(
        array $responses,
        ?array &$history = null,
        ?Account $account = null,
        ?CacheInterface $cache = null
    ): Client {
        $account = $account ?? $this->defaultAccount();
        $cache = $cache ?? new ArrayCache();

        $stack = HandlerStack::create(new MockHandler($responses));

        if ($history !== null) {
            $stack->push(Middleware::history($history));
        }

        return new Client($account, $cache, ['handler' => $stack]);
    }

    protected function defaultAccount(): Account
    {
        return (new Account())
            ->setUsername('user')
            ->setPassword('secret');
    }

    /**
     * Pre-populate the cache with a valid token so that token requests are
     * skipped and tests can focus on the actual API call.
     */
    protected function seedCachedToken(CacheInterface $cache, Account $account, string $token = 'cached-token'): void
    {
        $key = 'cr_correios_tk_' . implode('_', [
            $account->getUsername() ?? '',
            $account->getContract() ?? '',
            $account->getPostcard() ?? '',
        ]);

        $cache->set($key, Token::create([
            'token' => $token,
            'expiraEm' => Carbon::now()->addHour()->toIso8601String(),
        ]));
    }

    /**
     * A JSON token response body usable as the first queued response.
     */
    protected function tokenResponse(string $token = 'fake-token'): Response
    {
        return $this->jsonResponse(201, [
            'token' => $token,
            'expiraEm' => Carbon::now()->addHour()->toIso8601String(),
        ]);
    }

    protected function jsonResponse(int $status, array $body): Response
    {
        return new Response($status, ['Content-Type' => 'application/json'], json_encode($body));
    }
}
