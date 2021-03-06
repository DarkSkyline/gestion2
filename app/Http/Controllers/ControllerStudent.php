<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;


class ControllerStudent extends Controller
{
    public function lister_etudiants(){
        $students = Student::all();//Fonction qui liste les étudiants
        return view('students/lister_students',[
            'students'=> $students,
        ]);
    }
    public function formulaire(){
        return view('students/inscription_students');
    }
    public function inscription_students(){


        request()->validate([
            'id' => ['required'],
            'name' => ['required'],
            'first_name' => ['required'],
            'class' => ['required'],
            'cv' => ['required'],
            'date_n' => ['required'],
            'motivation' => ['required'],
            'status' => ['required'],

        ]);

        $entreprise = Student::create([
            'id' => request('id'),
            'name' => request('name'),
            'first_name' => request('first_name'),
            'class' => request('class'),
            'cv' => request('cv'),
            'date_n' => request('date_n'),
            'motivation' => request('motivation'),
            'status' => request('status'),

        ]);

        return view('prise_en_compte_inscription');

    }

    public function destroy($id){

        $student=Student::find($id);
        $student->delete();
        return view('modification_prise_en_compte');
    }






}
