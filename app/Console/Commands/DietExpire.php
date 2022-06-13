<?php

namespace App\Console\Commands;

use App\Models\UserDiet;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DietExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user_diet:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diet user active after 20 days ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $user_diet_actives =  UserDiet::where('active',1) -> get();
        foreach ($user_diet_actives as $key => $user_diet)
        {
                $created = new Carbon($user_diet -> created_at);
                $now = Carbon::now();
                if ($created->diff($now)->days > 20)
                {
                    $user_diet -> active = 0;
                    $user_diet -> save();
                }
        }
    }
}
