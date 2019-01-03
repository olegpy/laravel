<?php

namespace App\Repositories;

use App\Models\Proposal;
use App\Repositories\Contracts\ProposalRepositoryContract;

class ProposalRepository extends Repository implements ProposalRepositoryContract
{
    public function model()
    {
        return Proposal::class;
    }
}
