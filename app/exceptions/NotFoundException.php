<?php

namespace App\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class NotFoundException extends Exception implements HttpExceptionInterface
{
    protected $code = 404;
    protected $message = 'The requested resource was not found';
    private ?ResponseInterface $response;

    /**
     * @param string|null $message Custom error message
     * @param Throwable|null $previous Previous exception for chaining
     * @param ResponseInterface|null $response Optional PSR-7 response
     */
    public function __construct(
        string $message = null,
        Throwable $previous = null,
        ResponseInterface $response = null
    ) {
        if ($message !== null) {
            $this->message = $message;
        }

        $this->response = $response;

        parent::__construct($this->message, $this->code, $previous);
    }

    /**
     * Get the HTTP status code for this exception
     */
    public function getStatusCode(): int
    {
        return $this->code;
    }

    /**
     * Get the PSR-7 response associated with this exception (if any)
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * Create a 404 Not Found exception for a specific resource type
     */
    public static function forResource(string $resourceType, $resourceId = null): self
    {
        $message = sprintf(
            '%s%s could not be found',
            $resourceType,
            $resourceId ? " with ID {$resourceId}" : ''
        );

        return new self($message);
    }

    /**
     * Create a 404 Not Found exception for a route
     */
    public static function forRoute(string $route): self
    {
        return new self("Route '{$route}' could not be found");
    }
}

interface HttpExceptionInterface
{
    public function getStatusCode(): int;
    public function getResponse(): ?ResponseInterface;
}