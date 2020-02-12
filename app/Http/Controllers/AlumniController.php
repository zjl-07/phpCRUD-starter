<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumni;
use Validator;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumni = Alumni::all();
        return view('alumni', compact('alumni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insert-alum');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $checkValid = $this->validateAlumni($request->all());

        if($checkValid->fails()){
            return redirect()->back()
                        ->withErrors($checkValid)
                        ->withInput();
        }else{
            $alum = new Alumni();
            $alum->name = $request->name;
            $alum->angkatan = $request->angkatan;
            $alum->email = $request->email;
            $alum->no_telp = $request->no_telp;
            $alum->tempat_lahir = $request->tempat_lahir;
            $alum->tanggal_lahir = $request->tanggal_lahir;
            $alum->alamat = $request->alamat;
            $alum->gender = $request->gender;
    
            $alum->save();
        }
        

        return redirect('/alumni');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alum = Alumni::find($id);
        return view('update-alum', compact('alum'));
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
        $checkValid = $this->validateAlumni($request->all());

        if($checkValid->fails()){
            return redirect()->back()
                        ->withErrors($checkValid)
                        ->withInput();
        }else{ 
            $alum = Alumni::find($id);
            $alum->name = $request->name;
            $alum->angkatan = $request->angkatan;
            $alum->angkatan = $request->angkatan;
            $alum->email = $request->email;
            $alum->no_telp = $request->no_telp;
            $alum->tempat_lahir = $request->tempat_lahir;
            $alum->tanggal_lahir = $request->tanggal_lahir;
            $alum->alamat = $request->alamat;
            $alum->gender = $request->gender;
    
            $alum->update();
        }

        return redirect('/alumni');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alumni::find($id)->delete();

        return redirect('/alumni');
    }


    protected function validateAlumni(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:alumni', 'email'],
            'alamat' => ['required'],
            'no_telp' => ['required', 'unique:alumni'],
            'angkatan' => ['required', 'max:4', 'min:4'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'gender'=>['required', 'in:male,female']
        ]);
    }
}
