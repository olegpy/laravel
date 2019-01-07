<?php

namespace App\Http\Controllers;

use App\Http\Requests\Proposal\ProposalStoreRequest;
use App\Http\Requests\Proposal\ProposalUpdateReadedRequest;
use App\Http\Services\Contracts\ProposalServiceContract;
use App\Models\Proposal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProposalController extends Controller
{
    /** @var ProposalServiceContract */
    protected $proposalContract;

    /**
     * @param ProposalServiceContract $proposalContract
     */
    public function __construct(ProposalServiceContract $proposalContract)
    {
        $this->proposalContract = $proposalContract;
    }

    /**
     * Return list proposals if you are admin and form if not admin
     *
     * @return View
     */
    public function index(): View
    {
        $proposals = $this->proposalContract->list(['user']);

        return view('index')->with([
            'proposals' => $proposals
        ]);
    }

    /**
     * @param ProposalStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ProposalStoreRequest $request): RedirectResponse
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $resultMessages = $this->proposalContract->store(array_merge(
            $request->validated(),
            ['user_id' => auth()->user()->id]
        ));

        return redirect()->back()->with($resultMessages);
    }


    /**
     * @param Proposal $proposal
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(Proposal $proposal)
    {
        return $this->proposalContract->download($proposal->attached_file);
    }

    public function update(ProposalUpdateReadedRequest $request, Proposal $proposal)
    {
        dd('at the update');
    }
}
