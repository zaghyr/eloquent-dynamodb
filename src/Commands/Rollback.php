<?php
namespace Zaghyr\EloquentDynamoDb\Commands;

use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

class Rollback extends BaseCommand
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'dynamodb:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback migration for DynamoDB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return;
        }

        $migrationsData = $this->getMigrationsData();
        $batch = $this->getLastBatchNumber($migrationsData);
        $migrationsRunFile = array_where($migrationsData, function ($value) use ($batch) {
            return $value['batch'] == $batch;
        });
        foreach ($migrationsRunFile as $item) {
            $this->runRollback($item['name'], $item['batch']);
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
        ];
    }
}
