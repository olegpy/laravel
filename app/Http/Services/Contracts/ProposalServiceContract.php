<?php

namespace App\Http\Services\Contracts;

use App\Models\Proposal;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface ProposalServiceContract extends ServiceContract
{
    /**
     * @param array $data
     *
     * @return Collection
     */
    public function list(array $data): Collection;

    /**
     * @param int $userId
     * @param string $date
     *
     * @return int
     */
    public function countByDate(int $userId, string $date): int;

    /**
     * @param string $url

     * @return StreamedResponse
     */
    public function download(string $url): StreamedResponse;
}
