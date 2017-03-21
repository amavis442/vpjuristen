<?php

namespace App\Http\Controllers\Frontend;

use App\Dossier;
use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DossierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dossier = new Dossier;
        return view('dossier.create', ['dossier' => $dossier]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* if (!session()->has('client_id') || !session()->has('debtor_id')) {
            \Redirect::route('dossier-create');
        } */

        $dossier = $request->get('dossier');

        $data['client_id'] = session('client_id',1);
        $data['debtor_id'] = session('debtor_id',1);
        $data['title'] = $dossier['name'];
        /** @var Dossier $dossier */
        $dossier = Dossier::create($data);


        $this->validate($request, [
            'doc' => 'file|mimes:pdf,doc,docx,jpeg,png,jpg,gif,svg|max:2048'
        ]);


        /* $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); */

        //$imageName = time() . '.' . $request->image->getClientOriginalExtension();
        //$request->image->move(public_path('images'), $imageName);
        $doc = $request->file('doc');
        $filename = $doc->store('images');

        $invoice['dossier_id'] = $dossier->id;
        $invoice['amount'] = '100.00';
        $invoice['due_date'] = date('Y-m-d');
        $invoice['file'] = $filename;

        Invoice::create($invoice);

        return \Redirect::route('dossier-create');

        //foreach ($request->file('doc') as $doc) {
            //$filename = $doc->store('doc');
            //Invoice::create()->store();
        //}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dossier $dossier
     * @return \Illuminate\Http\Response
     */
    public function show(Dossier $dossier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dossier $dossier
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
     * @param  \App\Dossier $dossier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dossier $dossier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dossier $dossier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dossier $dossier)
    {
        //
    }

    public function imageUploadPost(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        return back()
            ->with('success', 'Image Uploaded successfully.')
            ->with('path', $imageName);

    }
}
