<?php

namespace App\Http\Services\Contracts;

use Symfony\Component\HttpFoundation\StreamedResponse;

interface StorageServiceContract
{
    /**
     * @param array $storageParameters
     * @param array $data
     *
     * @return array|null
     */
    public function create(array $storageParameters, array $data): ?string;

    /**
     * @param $url
     *
     * @return StreamedResponse
     */
    public function download($url): StreamedResponse;
}
