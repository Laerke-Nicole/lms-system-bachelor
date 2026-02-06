<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('uploads_disk')) {
    /**
     * Get the configured uploads disk instance.
     *
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    function uploads_disk()
    {
        return Storage::disk(config('filesystems.uploads'));
    }
}

if (!function_exists('uploads_url')) {
    /**
     * Get the URL for an uploaded file.
     *
     * @param  string|null  $path
     * @return string|null
     */
    function uploads_url($path)
    {
        if (!$path) {
            return null;
        }

        return uploads_disk()->url($path);
    }
}
