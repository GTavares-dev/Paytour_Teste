<?php

namespace app\Http\Controllers;

use App\Curriculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoFormRequest;
use Illuminate\Support\Str;

class CurriculoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        return view('form');
    }

    public function form(CurriculoFormRequest $request)
    {

        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_ALL, 'pt_BR');
        $date_time = explode(' ', date('d/m/Y h:i:s'));

        $slug = Str::of($request->email)->slug('-') . '.' . $request->file('file')->getClientOriginalExtension();
        $path = $request->file('file')->storeAs('curriculum', $slug);

        $data = array_merge($request->all(), [
            'file_upload' => $path,
            'date_send' => $date_time[0],
            'hour_send' => $date_time[1],
            'user_ip' => $request->ip(),
        ]);

        Curriculo::create($data);




        return redirect()->route('index');
    }
}
