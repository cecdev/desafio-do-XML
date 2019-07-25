<?php

namespace App\Console\Commands;

use App\Services\XmlZipService;
use Illuminate\Console\Command;
use App\Notifications\ZipGenerate;
use App\Entities\XmlDownloadControl;

class ProcessControlXML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '84CodeArt:ProcessCtrlXML';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adiciona as chamadas do Crontole XML a fila do laravel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $xmlZipService;
    public function __construct(XmlZipService $xmlZipService)
    {
        parent::__construct();
        $this->xmlZipService = $xmlZipService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // XmlDownloadControl::where('status','!=', 0)->update(['status' => 0]);
        $data = XmlDownloadControl::where('status', 0)->get()->map(function($row){

            $row->status = 1;
            $row->save();
            $user = $row->user;
            $data_process = $this->xmlZipService->makeZipAllCompanysXML($row);
            if(!empty($data_process)):
                $row->status = 2;
                $row->path = $data_process;
                $row->save();
                $user->notify(new ZipGenerate($row));
            else:
                $row->status = 0;
                $row->save();
            endif;
            //
          //  dd($data_process);

        });
    }
}
