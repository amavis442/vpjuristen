<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\DossierRepositoryInterface;
use App\Services\DossierSummaryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dossier;
use Illuminate\Support\Collection;

class DossierController extends Controller
{
    protected $dossierService;
    protected $dossierRepository;

    public function __construct(DossierRepositoryInterface $dossierRepository)
    {
        $this->dossierRepository = $dossierRepository;
    }

    private function getDossier(Collection $dossiers): Collection
    {
        $data = new Collection();
        /** @var \App\Models\Dossier $dossier */
        foreach ($dossiers as $dossier) {
            $item = new Collection();
            $item->put('dossier', $dossier);
            $item->put('dossierstatus', $dossier->dossierstatus);
            $companies = $dossier->companies;
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

        return view('dossier.admin.index', ['data' => $data]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dossier $dossier)
    {
        $dossierSummaryService = new DossierSummaryService($dossier);

        $summary = $dossierSummaryService->getSummary();

        return view('dossier.admin.view', [
            'fileRoute' => 'file.download',
            'invoiceRoute' => 'invoice.show',
            'routeEditClient' => 'admin.client.edit',
            'summary' => $summary
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dossier $dossier)
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
    public function update(Request $request, Dossier $dossier)
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

    public function search()
    {
        $searchTerm = request('q');
        if (!is_null($searchTerm)) {
            $dossiers = $this->dossierRepository->search($searchTerm);
        } else {
            $dossiers = Dossier::with('companies', 'actions', 'dossierstatus')->get();
        }

        $data = $this->getDossier($dossiers);

        return view('dossier.admin.index', ['data' => $data]);
    }

}
