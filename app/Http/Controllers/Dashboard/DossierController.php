<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Collections\ArrayCollection;
use App\Dossier;
use App\Invoice;
use App\File as InvoiceFile;
use App\Domain\Repository\DossierRepository;
use App\Domain\Services\Dossier\DossierService;

class DossierController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService();
    }


    //
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('client')) {
            $dossiers = $user->companies()->first()->dossiers()->with(['actions','dossierstatus'])->get();
        } else {
            $dossiers = [];
        }

        return view('dashboard.dossier.index', ['dossiers' => $dossiers]);
    }

    public function view($id)
    {
        $dossier = Dossier::findOrFail($id);

        if (!$this->authorize('view', $dossier)) {
            session('msg', 'Forbidden access attempt. A report has been filed.');
            return \Redirect::route('dashboard.home');
        }

        $summary = $this->dossierService->getSummary($id);

        return view('dashboard.dossier.view', [
            'fileRoute' => 'dashboard.file.download',
            'routeEditClient' => 'dashboard.client.edit',
            'summary' => $summary
        ]);
    }


    public function edit(Request $request)
    {
        $dossierid = $request->get('id');

        $user = Auth::user();
        $dossier = Dossier::findOrFail($dossierid);
        // checken of user wel bij deze gebruiker hoort
        $dossier = $user->companies()
            ->first()
            ->dossiers()
            ->findOrFail($dossierid);
        /** @var ArrayCollection $invoices */
        $invoices = $dossier->invoices;
        session(['numInvoices' => $invoices->count()]);

        return view('dashboard.dossier.edit', ['dossier' => $dossier, 'invoices' => $invoices, 'prefix'=>'dashboard']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'doc' => 'file|mimes:pdf,doc,docx,jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data = $request->get('dossier');
        $dossier = Dossier::findOrFail($data['id']);
        $dossier->update($data);

        $invoices = $request->get('invoice');
        foreach ($invoices as $index => $invoiceData) {
            $invoiceData['dossier_id'] = $dossier->id;
            $invoice = Invoice::updateOrCreate($invoiceData);

            $doc = $request->file('invoice_' . $index . '_file');
            if (!is_null($doc)) {

                $filename = $doc->store('invoices');
                $filename_org = $doc->getClientOriginalName();

                /** @var InvoiceFile $invoiceFile */
                $invoiceFile = InvoiceFile::updateOrCreate(['filename' => $filename, 'filename_org' => $filename_org]);
                $invoiceFile->invoices()->attach($invoice->id)->withTimestamps();
            }

        }

        return \Redirect::route('dashboard.dossier.index');
    }


    public function search(DossierRepository $repository)
    {
        $user = Auth::user();
        $searchTerm = request('q');
        if (!is_null($searchTerm)) {
            $dossiers = $repository->search($searchTerm);
        } else {
            $dossiers = $user->companies()->first()->dossiers()->get();
        }
        return view('dashboard.dossier.index', ['dossiers' => $dossiers]);
    }
}
