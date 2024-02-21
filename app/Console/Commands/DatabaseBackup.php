<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Symfony\Component\Console\Output\ConsoleOutput;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    public $response;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automating Daily Backups';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        if (!Storage::exists('backup')) {
            Storage::makeDirectory('backup');
        }

        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";
        $location = storage_path() . "/app/backup/" . $filename;

        $mactest = php_uname('s') == 'Darwin' ? true : false;

        if ($mactest) {
            $path = '/Applications/XAMPP/xamppfiles/bin/';
        } else {
            $path = '';
        }

        $command = $path . "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD')
            . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE')
            . "  | gzip > " . $location;

        $out = new ConsoleOutput();

        try {

            $returnVar = NULL;
            $output = NULL;

            exec($command, $output, $returnVar);

            $message = "Backup database is successfuly <br> <a href='" . route('settings.downloadbackup', $filename) . "' class='btn btn-primary btn-sm'>Download Now </a>";
            $out->writeln($message);

        } catch (\Exception $e) {
            $message = 'Backup database is failed \n ' . $e->getMessage();
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
