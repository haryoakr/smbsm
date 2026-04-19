<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jurnal;
use App\Models\Skripsi;

class SkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skripsis = Skripsi::all();

        $jurnals = Jurnal::all();

        $data_jurnal_dan_kemiripan = [];
        $temp = [];
        $i = 1;
        foreach ($jurnals as $key => $value) {
            $temp[0] = $i;
            $temp[1] = $value['judul'];
            $temp[2] = app(CousineSimilarityController::class)
            ->check_cousine_similarity($value["abstrak_terproses"],$skripsis[0]["abstrak_terproses"]);
            $temp[2] = round($temp[2], 2);

            $i++;
            $data_jurnal_dan_kemiripan[$i-1] = $temp;
        }

        $data_keyword =explode(" ",$skripsis[0]["abstrak_terproses"]) ;

        return view('skripsis.index', [
        'skripsis' => $skripsis, 
        'data_jurnal' => $data_jurnal_dan_kemiripan,
        'data_keyword' => $data_keyword
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skripsis.create');
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

        $newProduct = Skripsi::create($data);

        return redirect(route('skripsi.index'));
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
    public function edit(Skripsi $skripsi)
    {
        return view('skripsis.edit', ['skripsi' => $skripsi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skripsi $skripsi)
    {
        $data = $request->validate([
            'judul' => 'required',
            'abstrak' => 'required'
        ]);

        $skripsi->update($data);

        return redirect(route('skripsi.index'))->with('success', 'Skripsi Updated Succesffully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
