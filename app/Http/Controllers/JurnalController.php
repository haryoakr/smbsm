<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jurnal;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnals = Jurnal::all();

        return view('jurnals.index', ['jurnals' => $jurnals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurnals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'abstrak' => 'required'
        ]);

        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();

        // stem
        $sentence = $data['abstrak'] . " " . $data['judul'];
        $output   = $stemmer->stem($sentence);

        $stopwordFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopword  = $stopwordFactory->createStopWordRemover();

        $output   = $stopword->remove($output);

        $data['abstrak_terproses'] = $output;

        $newProduct = Jurnal::create($data);

        return redirect(route('jurnal.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurnal $jurnal)
    {
        return view('jurnals.edit', ['jurnal' => $jurnal]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        $data = $request->validate([
            'judul' => 'required',
            'abstrak' => 'required'
        ]);

        $jurnal->update($data);

        return redirect(route('jurnal.index'))->with('success', 'Jurnal Updated Succesffully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
