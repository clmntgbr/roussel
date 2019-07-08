<?php

namespace App\Util;

use App\Entity\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader
{
    const BASE_PATH = '%s/%s/';

    /* @var File */
    private $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function upload(?UploadedFile $uploadedFile, ?Media $media, string $type, string $directory): ?Media
    {
        $this->file->createDirectoryIfDontExist(sprintf(self::BASE_PATH, $type, $directory));

        if($uploadedFile === null) {
            return null;
        }

        $filename = sprintf('%s.%s', md5(uniqid()), $uploadedFile->guessExtension());

        $uploadedFile->move(sprintf(self::BASE_PATH, $type, $directory), $filename);

        if($media instanceof Media) {
            return $media->updateMedia(
                $filename,
                $type,
                sprintf(self::BASE_PATH, $type, $directory)
            );
        }

        return new Media(
            $filename,
            $type,
            sprintf(self::BASE_PATH, $type, $directory)
        );
    }
}
