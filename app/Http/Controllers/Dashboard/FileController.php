<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Domain\Repository\EloquentDossiersRepository;
use App\Domain\Services\Dossier\DossierService;
use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dossier;

class FileController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService();
    }


    /**
     * @param $id
     * @param $fileid
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function download(Request $request, File $file)
    {
        if (!$this->authorize('download', $file)){
            return response('File not found',404);
        }

        $dossierService = new DossierService();

        $collection = $dossierService->downloadFile($file);
        if ($collection->get('result') == 200) {
            return response()->download($collection->get('msg'));
        } else {
            return response($collection->get('msg'), $collection->get('result'));
        }
    }
}
