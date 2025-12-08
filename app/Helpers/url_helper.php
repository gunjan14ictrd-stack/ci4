<?php

if (!function_exists('url_is')) {
    /**
     * Check if the current URL matches a given pattern
     *
     * @param string $path
     * @return bool
     */
    function url_is(string $path): bool
    {
        $request = service('request');
        
        // Get the current path
        $currentPath = $request->getPath();
        $currentPath = trim($currentPath, '/ ');
        $path = trim($path, '/ ');
        
        // Handle wildcard paths (e.g., 'admin/*')
        if (str_ends_with($path, '*')) {
            $path = rtrim($path, '*');
            return str_starts_with($currentPath, $path);
        }
        
        return $currentPath === $path;
    }
}