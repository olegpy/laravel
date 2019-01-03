<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\ProposalContract;
use App\Repositories\Contracts\ProposalRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class ProposalService implements ProposalContract
{
    /** @var UserRepositoryContract */
    protected $proposalRepository;

    public function __construct(ProposalRepositoryContract $proposalRepository)
    {
        $this->proposalRepository = $proposalRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Model
    {
        return $this->proposalRepository->create($data);
    }

    public function list()
    {
        return $this->proposalRepository->with(['user']);
    }
}
