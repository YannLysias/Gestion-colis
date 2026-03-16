<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteArrivedColis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-arrived-colis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Models\Colis::where('statut', 'arrivé')
        ->delete();

        $this->info('Colis arrivés supprimés.');
    }
}
