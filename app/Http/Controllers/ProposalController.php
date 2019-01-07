<?php

namespace App\Http\Controllers;

use App\Http\Requests\Proposal\ProposalStoreRequest;
use App\Http\Requests\Proposal\ProposalUpdateReadedRequest;
use App\Http\Services\Contracts\ProposalServiceContract;
use App\Models\Proposal;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
     * @return StreamedResponse
     */
    public function download(Proposal $proposal): StreamedResponse
    {
        return $this->proposalContract->download($proposal->attached_file);
    }

    /**
     * @param ProposalUpdateReadedRequest $request
     * @param Proposal $proposal
     *
     * @return RedirectResponse
     */
    public function update(ProposalUpdateReadedRequest $request, Proposal $proposal): RedirectResponse
    {
        $this->proposalContract->update($request->validated(), $proposal);

        return redirect()->back()->with(['message' => __('messages.results.update.message', ['name' => $proposal->user->name])]);
    }
}
