<?php

declare(strict_types=1);

namespace App\Views;

class ViewRenderer
{
    private string $viewsBasePath;
    private array $globalVariables = [];

    public function __construct(string $viewsBasePath = 'app/views/')
    {
        $this->viewsBasePath = rtrim($viewsBasePath, '/') . '/';
    }

    /**
     * Add a global variable that will be available to all views
     */
    public function addGlobal(string $name, mixed $value): void
    {
        $this->globalVariables[$name] = $value;
    }

    /**
     * Render a view with the given data
     */
    public function render(string $viewPath, array $data = []): void
    {
        $fullPath = $this->viewsBasePath . $viewPath . '.php';

        if (!file_exists($fullPath)) {
            throw new \RuntimeException("View file not found: {$fullPath}");
        }

        // Extract both the provided data and global variables
        extract(array_merge($this->globalVariables, $data), EXTR_SKIP);

        // Start output buffering
        ob_start();

        try {
            include $fullPath;
            echo ob_get_clean();
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }
    }

    /**
     * Render a view and return its content as a string
     */
    public function fetch(string $viewPath, array $data = []): string
    {
        ob_start();
        $this->render($viewPath, $data);
        return ob_get_clean();
    }

    /**
     * Escape output to prevent XSS attacks
     */
    public function escape(mixed $value): string
    {
        if (is_array($value)) {
            return json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Include a partial view
     */
    public function partial(string $partialPath, array $data = []): void
    {
        $this->render($partialPath, $data);
    }
    
    public function renderError(int $statusCode, string $message = ''): void
{
    http_response_code($statusCode);
    
    $errorView = "errors/{$statusCode}";
    if (!file_exists($this->viewsBasePath . $errorView . '.php')) {
        $errorView = 'errors/generic';
    }
    
    $this->render($errorView, [
        'statusCode' => $statusCode,
        'message' => $message
    ]);
    
    exit;
}
}