<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\ProposalServiceContract;
use App\Http\Services\Contracts\StorageServiceContract;
use App\Repositories\Contracts\ProposalRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Carbon\Carbon;
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

        $status = __('messages.results.success.status');
        $message = __('messages.results.success.message', ['type' =>'proposal']);

//        if ($this->countByDate($data['user_id'], Carbon::today()->toDateString())) {
//            $status = __('messages.results.error.status');
//            $message = __('messages.results.success.message', ['type' =>'proposal']);
//        }

        $this->proposalRepository->create($data);

        return [
            'status' => $status,
            'message' => $message
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function list(array $data): Collection
    {
        return $this->proposalRepository->with($data);
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
}
