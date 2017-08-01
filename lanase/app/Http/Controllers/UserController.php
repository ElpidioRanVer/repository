<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('panel.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('panel.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        // dd($request->all());
        $user = new User($request->all());
        $user->password = bcrypt($user->password);
        // $user->status = 1;
        if($user->save()){
            Flash::overlay('Se ha registrado '.$user->name.' de forma exitosa.', 'Alta exitosa');            
        }else{
            Flash::overlay('Ha ocurrido un problema al registrar '.$user->name, 'Error');
        }

        return redirect()->route('users.create');
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


    public function getUsers(Request $req)
    {
        $type = $req->input('type');

        switch($type){
            case "all":
                $res = User::all();
                break;
            case "admin":
                $res = User::where('role', 1)->get();
                break;
            case "user":
                $res = User::where('role', 2)->get();
                break;
        }

        // dd($res);

        $str = "";

        foreach ($res as $user) {
            $str .= "<tr><td>".$user->name."</td><td>".$user->email."</td><td>";

            if($user->status == 1){
                $str .= "<span class='badge1 green white-text'>Activo</span>"; 
            }else{ 
                $str .= "<span class='badge1 grey white-text'>Inactivo</span>";
            }

            $str .="</td><td>";

            if($user->role == 1){
                $str .= "<span class='badge1 teal white-text'>Admin</span>"; 
            }else{ 
                $str .= "<span class='badge1 blue white-text'>User</span>";
            }

            $str .= "<td>
                        <a href='#!'><i class='material-icons brown-text'>receipt</i></a>
                        <a href='#!'><i class='material-icons teal-text'>edit</i></a>
                        <a href='#!'><i class='material-icons red-text'>delete</i></a>
                    </td>";
        }

        if($str == ""){
            $str = "Sin resultados";
        }

        return $str;
        // return response()->json([

        // ]);
    }
}
