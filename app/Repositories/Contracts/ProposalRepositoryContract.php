<?php

namespace App\Repositories\Contracts;

interface ProposalRepositoryContract extends RepositoryContract
{
    /**
     * @param int $userId
     * @param string $date
     *
     * @return int
     */
    public function countByDate(int $userId, string $date): int;
}
