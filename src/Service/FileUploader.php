<?php

namespace App\Service;

use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{

    private SluggerInterface $slugger;
    private FilesystemInterface $filesystem;

    public function __construct(FilesystemInterface $articleFileSystem, SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->filesystem = $articleFileSystem;
    }

    public function uploadFile(File $file, ?string $oldFileName = null): string
    {
        $fileName = $this->slugger
            ->slug(pathinfo($file instanceof UploadedFile ? $file->getClientOriginalName() : $file->getFilename(), PATHINFO_FILENAME))
            ->append('-' . uniqid())
            ->append('.' . $file->guessExtension())
            ->toString()
        ;

        if ($oldFileName && $this->filesystem->has($oldFileName)) {
            $result = $this->filesystem->delete($oldFileName);
            if (! $result) {
                throw new \Exception('не удалось удалить файл');
            }
        }

        $stream = fopen($file->getPathname(), 'r');
        $result = $this->filesystem->writeStream($fileName, $stream);
        if (! $result) {
            throw new \Exception('не удалось записать файл');
        }
        if (is_resource($stream)) {
            fclose($stream);
        }



        return $fileName;
    }
}