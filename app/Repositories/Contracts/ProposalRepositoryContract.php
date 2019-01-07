<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProposalRepositoryContract extends RepositoryContract
{
    /**
     * @param int $userId
     * @param string $date
     *
     * @return int
     */
    public function countByDate(int $userId, string $date): int;

    /**
     * get list of model with relations
     *
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function list(array $data): LengthAwarePaginator;
}
