<?php

namespace App\Containers\Feedback\Settings\Providers;

use App\Containers\Feedback\Contracts\FeedbackRepositoryInterface;
use App\Containers\Feedback\Settings\Repositories\FeedbackRepository;
use App\Containers\Feedback\Contracts\CriteriaRepositoryInterface;
use App\Containers\Feedback\Settings\Repositories\CriteriaRepository;
use App\Containers\Feedback\Contracts\GradeRepositoryInterface;
use App\Containers\Feedback\Settings\Repositories\GradeRepository;
use App\Port\Provider\Abstracts\ServiceProviderAbstract;

use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class FeedbackServiceProvider.
 *
 * The Main Service Provider of this Module.
 * Will be automatically registered in the framework after
 * adding the Module name to containers config file.
 *
 * @author  Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackServiceProvider extends ServiceProviderAbstract
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Container internal Service Provides.
     *
     * @var array
     */
    private $containerServiceProviders = [
        PoliciesServiceProvider::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders($this->containerServiceProviders);

        // add morph class alias
        Relation::morphMap([
            'feedback' => User::class,
        ]);
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
        $this->app->bind(CriteriaRepositoryInterface::class, CriteriaRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);
    }
}
