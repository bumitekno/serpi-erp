<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Console\Output\ConsoleOutput;


class DatabaseRestore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $response;
    public $filename;

    /**
     * Create a new job instance.
     */
    public function __construct($filename)
    {
        //
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $mactest = php_uname('s') == 'Darwin' ? true : false;
        if ($mactest) {
            $path = '/Applications/XAMPP/xamppfiles/bin/';
        } else {
            $path = '';
        }

        $command = "gunzip < " . $this->filename . " | " . $path . "mysql -u " . env('ROOT_USER_NAME_MYSQL') . " -p " . env('ROOT_USER_PASSWORD_MYSQL') . " -h " . env('DB_HOST') . " " . env('DB_DATABASE');

        $out = new ConsoleOutput();

        $out->writeln($command);

        try {

            $returnVar = NULL;
            $output = NULL;

            exec($command, $output, $returnVar);

            $message = "Restore database is successfuly ";
            $out->writeln($message);
        } catch (\Exception $e) {
            $message = 'Restore database is failed \n ' . $e->getMessage();
            $out->writeln($message);
        }
        $this->response = $message;
    }

    /** get response */
    public function getResponse()
    {
        return $this->response;
    }
}
