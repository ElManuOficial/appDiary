<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objContact = new Contact();
        //forma 1 relationship eloquent 
        $objUser =\Auth::user();
        $data = $objUser->contacts()->get()->all();
        return $data;  
        //forma 2 query Builder
        /*$objUser = new User(); 
        $user_id = \Auth::user()->id;
        $data = $objUser
        ->where("contacts.user_id",$user_id)
        ->join('contacts', 'users.id', '=', 'contacts.user_id')
        ->select('contacts.*')
        ->get();*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('contact.register')->with(["error"=>false,"msj"=>""]);//contact es la carpeta y register es la vista dentro de esa
        

    }

    public function saveImg($file){
        $name_file=time().'_'.$file->getClientOriginalName(); 
        if(\Storage::disk('contacts')->put($name_file,file_get_contents($file->getRealPath()))){
            return $name_file;
        }else{
            return false;
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(ContactRequest $request)
    public function store(Request $request)
    {

        //dd($request);
        try {
            $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required'
            ]);
            $objContact = new Contact();

            $valid = true;
            if(!empty($request->image)){         
                $name_file=$this->saveImg($request->image);
                if($name_file){
                   $objContact->image=$name_file;
                }else{
                   $valid=false;
                }
           }


            $objContact->name = $request->name;
            $objContact->age = $request->age;
            $objContact->email = $request->email;
            $objContact->phone = $request->phone;
            $objContact->indenty = $request->identity;
            $objContact->user_id = \Auth::user()->id;
            if($valid){
                if($objContact->save()){
                    return view("contact.register")->with(["error"=>false,"msj"=>"Guardado con exito"]);
                }
            }
        } catch (\Throwable $th) {
            return view("contact.register")->with(["error"=>true,"msj"=>$th->getMessage()]);
        }


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact= Contact::find($id);
        dd($contact);

        /*forma 2 query Builder
        $objContact = new Contact(); 
        $data = $objContact
        ->where("contacts.id",$id)
        ->select('contacts.*')
        ->get();
        dd($data);*/




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
}
