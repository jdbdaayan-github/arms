<?php

if (! function_exists('asset'))
{
    /**
     * Generate asset URL with cache-busting
     *
     * @param string $path
     * @return string
     */
    function asset(string $path): string
    {
        $filePath = FCPATH . ltrim($path, '/');

        if (file_exists($filePath)) {
            $version = filemtime($filePath); // last modified time
            return base_url($path) . '?v=' . $version;
        }

        return base_url($path);
    }
}
