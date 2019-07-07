<?php

namespace App\Util;

use ZipArchive;

class File
{
    public function delete(string $filename): void
    {
        if (file_exists($filename)) {
            unlink($filename);
        }
    }
    public function deletes(array $filenames): void
    {
        foreach ($filenames as $filename) {
            if (file_exists($filename)) {
                unlink($filename);
            }
        }
    }
    public function download(string $url, string $zipfile, string $extractPath): void
    {
        $this->createDirectoryIfDontExist($extractPath);
        file_put_contents($zipfile, fopen($url, 'r'));
    }
    public function createDirectoryIfDontExist(string $path): void
    {
        if (!($this->exist($path))) {
            mkdir($path, 0777, true);
        }
    }
    public function exist(string $path): bool
    {
        if (file_exists($path)) {
            return true;
        }
        return false;
    }
    public function unzip(string $zipfile, string $extractPath, string $filename, string $xmlFile): bool
    {
        $zip = new ZipArchive;
        if ($zip->open($zipfile) != 'true') {
            return false;
        }
        $zip->extractTo($extractPath);
        $zip->close();
        rename($extractPath . $filename, $extractPath . $xmlFile);
        return true;
    }
}
