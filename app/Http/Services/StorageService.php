<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\StorageServiceContract;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageService implements StorageServiceContract
{
    /**
     * {@inheritdoc}
     */
    public function create(array $storageParameters, array $data): ?string
    {
        $nameField = $this->nameFromStorageParameters('nameField', $storageParameters);
        $folderStorageName = $this->nameFromStorageParameters('folderStorageName', $storageParameters);

        return array_key_exists($nameField, $data) ? Storage::disk('public')->put($folderStorageName, $data[$nameField]) : "";
    }

    /**
     * {@inheritdoc}
     */
    public function download($url): StreamedResponse
    {
        return Storage::disk('public')->download($url);
    }

    /**
     * @param string $nameParameter
     * @param array $storageParameters
     *
     * @return string
     */
    private function nameFromStorageParameters(string $nameParameter, array $storageParameters): string
    {
        return $storageParameters[$nameParameter];
    }
}
