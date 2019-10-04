<?php

namespace App\Http\Controllers\Api;

use App\Media;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Api\MediaResource;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;


class MediaController extends Controller
{
    use ApiResponseTrait;

    public function store(FileReceiver $receiver)
    {
        // check if the upload is success
        if ($receiver->isUploaded()) {

            // receive the file
            $save = $receiver->receive();

            // check if the upload has finished (in chunk mode it will send smaller files)
            if ($save->isFinished()) {
                // save the file and return any response you need
                return $this->saveFile($save->getFile());
            } else {
                // we are in chunk mode, lets send the current progress

                /** @var AbstractHandler $handler */
                $handler = $save->handler();

                return response()->json([
                    "done" => $handler->getPercentageDone(),
                ]);
            }
        } else {
            throw new UploadMissingFileException();
        }
    }

    protected function saveFile($uploadedFile)
    {

        $path = getFolderPathForId(Media::getNextSequenceId());
        $fileName = Uuid::uuid1() . '.' . $uploadedFile->extension();

        if (!Storage::disk('uploads')->putFileAs($path, $uploadedFile, $fileName)) {
            return $this->respondWithError('El documento no logro ser almacenado.');
        };
        $media = new Media();
        $media->extension = $uploadedFile->extension();
        $media->path = $path . $fileName;
        $media->name = $uploadedFile->getClientOriginalName();
        $media->size = $uploadedFile->getClientSize();
        $media->mime_type = $uploadedFile->getClientMimeType();
        $media->status = 2;
        $media->save();

        return $this->respondWithData(['media' => new MediaResource($media)]);
    }

}