<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Domain\Repository\EloquentDossiersRepository;
use App\Domain\Services\Dossier\DossierService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dossier;
use App\File;
use Illuminate\Support\Collection;

class DossierController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService();
    }

    private function getDossier(Collection $dossiers): Collection
    {
        $data = new Collection();
        /** @var \App\Dossier $dossier */
        foreach ($dossiers as $dossier) {
            $item = new Collection();
            $item->put('dossier', $dossier);
            $item->put('dossierstatus', $dossier->dossierstatus);
            $companies = $dossier->companies;//->withPivot('type')->get()->all();
            $actions = $dossier->actions;
            $item->put('actions', $actions);
            foreach ($companies as $company) {
                $item->put($company->pivot->type, $company);
            }
            unset($company);
            $data->push($item);
        }

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dossiers = Dossier::with('companies', 'actions', 'dossierstatus')->get();

        $data = $this->getDossier($dossiers);

        return view('admin.dossier.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dossierService = new \App\Domain\Services\Dossier\DossierService();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $summary = $this->dossierService->getSummary($id);

        return view('admin.dossier.view', [
            'fileRoute' => 'admin.file.download',
            'routeEditClient' => 'admin.client.edit',
            'summary' => $summary
        ]);
    }

    public function list($id, Request $request)
    {

        $company = null;
        // Can be client or debtor or both
        $company = Company::with(['dossiers'=>function($query){
            $query->with('companies','actions','comments','dossierstatus');
        }])->where('id', $id)->get()->first();

        $data = new Collection();
        $dossiers = $company->dossiers;
        /** @var \App\Dossier $dossier */
        foreach ($dossiers as $dossier) {
            $item = new Collection();
            $item->put('dossier', $dossier);

            $actions = $dossier->actions;
            $item->put('actions', $actions);

            $comments = $dossier->comments;
            $item->put('comments', $comments);

            $dossierstatus = $dossier->dossierstatus;
            $item->put('dossierstatus',$dossierstatus);

            // Client and Debtor
            $companiesAll = $dossier->companies;
            foreach ($companiesAll as $company) {
                $type = $company->pivot->type;
                $item->put($type, $company);
            }
            $data->push($item);
        }

        $returnUrl = back()->getTargetUrl();

        return view('admin.dossier.list', ['returnUrl' => $returnUrl, 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(EloquentDossiersRepository $repository)
    {
        $searchTerm = request('q');
        if (!is_null($searchTerm)) {
            $dossiers = $repository->search($searchTerm);
        } else {
            $dossiers = Dossier::with('companies', 'actions', 'dossierstatus')->get();
        }

        $data = $this->getDossier($dossiers);

        return view('admin.dossier.index', ['data' => $data]);
    }

    /**
     * @param $id
     * @param $fileid
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function downloadInvoice(File $file, Request $request)
    {

        $dossierService = new DossierService();

        $collection = $dossierService->downloadFile($file);
        //$collection = $dossierService->downloadInvoice($id, $fileid, $request);
        if ($collection->get('result') == 200) {
            return response()->download($collection->get('msg'));
        } else {
            return response($collection->get('msg'), $collection->get('result'));
        }
    }
}
