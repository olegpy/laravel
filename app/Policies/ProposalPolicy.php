<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create policies.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

//    /**
//     * Determine whether the user can update the policy.
//     *
//     * @param  \App\Models\User  $user
//     * @param  \App\Policy  $policy
//     * @return mixed
//     */
//    public function update(User $user, Policy $policy)
//    {
//        //
//    }
//
    /**
     * @param User $user
     * @param Proposal $proposal

     * @return bool
     */
    public function download(User $user, Proposal $proposal): bool
    {
        return $user->is_admin || $proposal->attached_file;
    }
}
