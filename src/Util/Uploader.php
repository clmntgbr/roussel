<?php

namespace App\Util;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Messenger\MessageBusInterface;

class Uploader
{
    const BASE_PATH = 'images/%s/';

    /* @var EntityManagerInterface */
    private $em;

    /* @var MessageBusInterface */
    private $messageBus;

    /* @var File */
    private $file;

    public function __construct(EntityManagerInterface $em, MessageBusInterface $messageBus, File $file)
    {
        $this->em = $em;
        $this->messageBus = $messageBus;
        $this->file = $file;
    }

    public function upload(?UploadedFile $uploadedFile, string $type, ?Media $media): ?Media
    {
        $this->file->createDirectoryIfDontExist(sprintf(self::BASE_PATH, $type));

        if($uploadedFile === null) {
            return null;
        }

        $filename = sprintf('%s.%s', md5(uniqid()), $uploadedFile->guessExtension());

        $uploadedFile->move(sprintf(self::BASE_PATH, $type), $filename);

        if($media instanceof Media) {
            return $media->updateMedia(
                $filename,
                $type,
                sprintf(self::BASE_PATH, $type)
            );
        }

        return new Media(
            $filename,
            $type,
            sprintf(self::BASE_PATH, $type)
        );
    }
}