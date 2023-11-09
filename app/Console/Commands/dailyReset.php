<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\blog;
use Illuminate\Http\Request;

class dailyReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dailyReset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Request $req)
    {  
       $blogData = blog::find(1);
        print_r("hello");   
        if(isset($blogData)){
        print_r(" <a href='https://www.facebook.com/sharer/sharer.php?u={$blogData['post_link']}'><button>Share with fb</button></a>");
        }
        //return Command::SUCCESS;
        //$this->info('Successfully sent daily quote to everyone.');
    
    }
}
