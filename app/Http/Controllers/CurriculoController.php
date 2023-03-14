<?php

namespace app\Http\Controllers;

use App\Curriculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoFormRequest;
use App\Mail\CurriculoMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
            'date_send' => $date_time[0],
            'hour_send' => $date_time[1],
            'user_ip' => $request->ip(),
            'path' => $path,
        ]);

        $Curriculo = Curriculo::create($data);

        Mail::to(config('mail.from.address'))->send(new CurriculoMail($Curriculo));




        return redirect()->route('index');
    }
}
