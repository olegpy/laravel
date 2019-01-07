<?php

namespace App\Repositories;

use App\Models\Proposal;
use App\Repositories\Contracts\ProposalRepositoryContract;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProposalRepository extends Repository implements ProposalRepositoryContract
{
    /**
     * {@inheritdoc}
     */
    public function model(): string
    {
        return Proposal::class;
    }

    /**
     * {@inheritdoc}
     */
    public function countByDate(int $userId, string $date): int
    {
        return $this->model->where('user_id', $userId)->where('created_at', 'LIKE', $date . '%')->count();
    }

    /**
     * get list of model with relations
     *
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function list(array $data): LengthAwarePaginator
    {
        return $this->model->orderBy('readed', 'asc')->with($data)->paginate(Proposal::PAGINATE_PAGE_COUNT);
    }
}
