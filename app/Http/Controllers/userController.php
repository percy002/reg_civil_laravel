<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Livewire\Component;
use Livewire\WithPagination;

use Response;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:editor|administrador']);
    }
    public function index()
    {
        //
        
        $usuarios = User::all();
        return view('usuarios.show', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user=new User($request->all());
        $user->password = bcrypt($request->password);
        // dd($request->rol);
        $user->assignRole($request->rol);
        if ($user->save()) {

            // return Response::json(array('success' => true), 200);
        }

        // dd($user->getRoleNames());
        return redirect('/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // dd($id);
        $usuario = User::find($id);

        // dd($user);
        // dd($user->hasRole("usuario"));
        return view('usuarios.update',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user=User::find($id);
        $user->nombres = $request->nombres;
        $user->apellido_materno = $request->apellido_materno;
        $user->apellido_paterno = $request->apellido_paterno;

        if ($request->password != "") {
            # code...
            $user->password = bcrypt($request->password);
        }
        // dd($request->rol);
        $user->roles()->detach();
        $user->assignRole($request->rol);
        // dd($user->getRoleNames());
        $user->update();

        // dd($user->getRoleNames());
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
