<?php

namespace App\Jobs;

use App\Exports\PackagesExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportPackageChunk implements ShouldQueue
{
    use Queueable;


    protected $packages;
    protected $fileName;

    /**
     * Create a new job instance.
     */
    public function __construct($packages, $fileName)
    {
        $this->packages = $packages;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::store(new PackagesExport($this->packages), 'public/' . $this->fileName);
    }
}
