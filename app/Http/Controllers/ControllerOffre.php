<?php

namespace App\Http\Controllers;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;


class ControllerOffre extends Controller
{
    public function lister_offres(){
        $offres = Offre::all();//Fonction qui liste les offres
        return view('offres/lister_offres',[
            'offres'=> $offres,
        ]);
    }
    public function formulaire(){
        return view('offres/inscription_offres');
    }
    public function inscription_offre(){


        request()->validate([
            'id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'start' => ['required'],
            'end' => ['required'],


        ]);

        $offre = Offre::create([
            'id' => request('id'),
            'name' => request('name'),
            'description' => request('description'),
            'start' => request('start'),
            'end' => request('end'),


        ]);

        return view('prise_en_compte_offre_creation');

    }

    public function destroy($id){

        $offre=Offre::find($id);
        $offre->delete();
        return view('modification_prise_en_compte');
    }



    public function edit($id){

            $offre= Offre::find($id);
            $offres = Offre::all();

        return view('offres/modifier_offres', compact('offre'));
    }

    public function update(Request $request, $id ){
        $this->validate($request,['id'=>'required|min:1', ]);

        $offre=Offre::find($id);
        $offre->name=$request->name;
        $offre->description=$request->description;
        $offre->start=$request->start;
        $offre->end=$request->end;
        $offre->save();

        return view('modification_prise_en_compte');
    }


}
