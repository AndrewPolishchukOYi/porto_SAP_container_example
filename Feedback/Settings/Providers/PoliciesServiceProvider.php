<?php

namespace App\Containers\Feedback\Settings\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Containers\Feedback\Models\Feedback;
use App\Containers\Feedback\Models\Criteria;
use App\Containers\Feedback\UI\API\Policies\FeedbackPolicy;
use App\Containers\Feedback\UI\API\Policies\FeedbackCriteriaPolicy;

/**
 * Class PoliciesServiceProvider.
 *
 * This Service Provider is designed to map the policies to their models.
 * Must be manually added to the list of extra service providers in the
 * containers config file in order to get registered in the framework.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class PoliciesServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Feedback::class => FeedbackPolicy::class,
        Criteria::class => FeedbackCriteriaPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //
    }
}
