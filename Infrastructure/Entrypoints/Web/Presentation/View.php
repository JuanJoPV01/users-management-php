<?php

declare(strict_types=1);

final class View
{
    /**
     * @param array<string, mixed> $data
     */
    public static function render(string $template, array $data = array()): void
    {
        $file = __DIR__ . '/Views/' . $template . '.php';

        if (!file_exists($file)) {
            throw new RuntimeException('Vista no encontrada: ' . $template);
        }

        extract($data, EXTR_SKIP);

        require $file;
    }

    public static function redirect(string $route, array $params = array()): void
    {
        $query = array_merge(array('route' => $route), $params);
        header('Location: ?' . http_build_query($query));
        exit;
    }
}