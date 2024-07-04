<?php

namespace App\Services;

use App\Enums\Media\MediaCollectionEnum;
use Spatie\MediaLibrary\HasMedia;
use Symfony\Component\HttpFoundation\File\File;

class MediaService
{
    public function saveSingleTypeImage(HasMedia $model, File $file, MediaCollectionEnum $collection): void
    {
        $model
            ->addMedia($file)
            ->toMediaCollection($collection->getType());
    }

    public function deleteLastMedia(HasMedia $model, MediaCollectionEnum $collection): bool
    {
        $lastMedia = $model->getMedia($collection->getType())->last();
        if ($lastMedia) {
            $lastMedia->delete();
            return true;
        }
        return false;
    }
}
