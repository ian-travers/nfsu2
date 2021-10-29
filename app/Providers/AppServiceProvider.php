<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Competition\Competition;
use App\Models\News;
use App\Models\Post;
use App\Models\Tourney\Tourney;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            /** @var LengthAwarePaginator $this */
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        Model::unguard();
        Model::preventLazyLoading(!$this->app->isProduction());
        Model::handleLazyLoadingViolationUsing(
            fn($model, $relation) => logger("Lazy loading violation:: load '$relation' on '" . get_class($model) . '\'')
        );

        Relation::morphMap([
            'tourney' => Tourney::class,
            'competition' => Competition::class,
            'news' => News::class,
            'post' => Post::class,
            'comment' => Comment::class,
        ]);
    }
}
