<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MencobaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function boomsport()
    {
        return view('boom');
    }

    public function daftarPerumahan()
    {
        $perumahan = DB::table('perumahan')->get();
        return view('perumahan', ['perumahan' => $perumahan]);
    }
}
?>
