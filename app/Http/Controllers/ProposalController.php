<?php

namespace App\Http\Controllers;

use App\Http\Services\Contracts\ProposalContract;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    /** @var ProposalContract */
    protected $proposalContract;

    /**
     * @param ProposalContract $proposalContract
     */
    public function __construct(ProposalContract $proposalContract)
    {
        $this->proposalContract = $proposalContract;
    }

    public function index()
    {
        $list = $this->proposalContract->list();
    }
}
