<?php

namespace App\Repositories\v1;

use App\Models\File as ModelsFile;
use App\Repositories\Contracts\FileRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FacadesFile;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    public function __construct(ModelsFile $model)
    {
        parent::__construct($model);
    }

    private function saveInStorage($file)
    {
        $filePath = time() . $file->getClientOriginalName();

        Storage::disk('public')->put($filePath, FacadesFile::get($file));

        $data['name'] = $filePath;
        $data['path'] = 'storage/' . $filePath;

        return $data;
    }

    public function store($attributes): Model
    {
        $data = $this->saveInStorage($attributes);

        return $this->model->create($data);
    }
}
