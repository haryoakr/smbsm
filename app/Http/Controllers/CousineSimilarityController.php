<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CousineSimilarityController extends Controller
{

    function check_cousine_similarity($text_1, $text_2)
    {
        similar_text($text_1, $text_2, $percent);
        return $percent;
    }
}
