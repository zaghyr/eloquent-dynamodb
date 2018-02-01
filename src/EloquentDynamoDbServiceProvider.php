<?php
namespace Zaghyr\EloquentDynamoDb;

use Illuminate\Support\ServiceProvider;
use Zaghyr\EloquentDynamoDb\Commands\MakeMigration;
use Zaghyr\EloquentDynamoDb\Commands\MakeModel;
use Zaghyr\EloquentDynamoDb\Commands\MakeSeed;
use Zaghyr\EloquentDynamoDb\Commands\Migrate;
use Zaghyr\EloquentDynamoDb\Commands\Reset;
use Zaghyr\EloquentDynamoDb\Commands\Rollback;
use Zaghyr\EloquentDynamoDb\Commands\Seed;

class EloquentDynamoDbServiceProvider extends ServiceProvider
{
    protected $commands = [
        MakeMigration::class,
        Migrate::class,
        Rollback::class,
        MakeSeed::class,
        Seed::class,
        Reset::class,
        MakeModel::class,
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
