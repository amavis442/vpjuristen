<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Company;
use App\Repositories\Eloquent\DossierRepository;
use App\Domain\Services\Dossier\DossierService;
use App\Models\File as InvoiceFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dossier;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService(new DossierRepository());
    }


    /**
     * @param $id
     * @param $fileid
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function download(Request $request, InvoiceFile $file)
    {
        $user = Auth::user();
        if (!$user->can('download', $file)){
            return response('File not found',404);
        }

        $dossierService = new DossierService(new DossierRepository());

        $collection = $dossierService->downloadFile($file);
        if ($collection->get('result') == 200) {
            return response()->download($collection->get('msg'));
        } else {
            return response($collection->get('msg'), $collection->get('result'));
        }
    }
}
