<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\ProposalServiceContract;
use App\Http\Services\Contracts\StorageServiceContract;
use App\Models\Proposal;
use App\Notifications\Proposal\CreateProposal;
use App\Repositories\Contracts\ProposalRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProposalService implements ProposalServiceContract
{
    /** @var UserRepositoryContract */
    protected $proposalRepository;

    /** @var StorageServiceContract */
    protected $storageService;

    public function __construct(ProposalRepositoryContract $proposalRepository, StorageServiceContract $storageService)
    {
        $this->proposalRepository = $proposalRepository;
        $this->storageService = $storageService;
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data): array
    {
        $data['attached_file'] = $this->storageService->create(['nameField' => 'attached_file', 'folderStorageName' => 'proposal'], $data);

        $status = __('messages.results.error.status');
        $message = __('messages.results.error.message', ['type' =>'proposal']);

        if (!$this->countByDate($data['user_id'], Carbon::today()->toDateString())) {
            $status = __('messages.results.success.status');
            $message = __('messages.results.success.message', ['type' =>'proposal']);

            /** @var Proposal $proposal */
            $proposal = $this->proposalRepository->create($data);
            $proposal->notify(new CreateProposal(config('app.email_admin')));
        }

        return [
            'status' => $status,
            'message' => $message
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function list(array $data): LengthAwarePaginator
    {
        return $this->proposalRepository->list($data);
    }

    /**
     * {@inheritdoc}
     */
    public function countByDate(int $userId, string $date): int
    {
        return $this->proposalRepository->countByDate($userId, $date);
    }

    /**
     * {@inheritdoc}
     */
    public function download(string $url): StreamedResponse
    {
        return $this->storageService->download($url);
    }

    /**
     * {@inheritdoc}
     */
    public function update(array $data, Proposal $proposal): void
    {
        $this->proposalRepository->updateByArray($proposal, $data);
    }
}
