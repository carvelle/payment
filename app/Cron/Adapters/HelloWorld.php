<?php 

namespace App\Cron\Adapters;

use Nova\Cron\Adapter;

class HelloWorld extends Adapter
{
    // The name of your Cron
    protected $name = 'Hello World';

    /**
     * Execute the CRON operations.
     */
    public function handle()
    {
        return 'Hello World!';
        // Or your complicated code here.
    }

}
?>