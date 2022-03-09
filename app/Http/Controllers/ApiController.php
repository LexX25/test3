<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ApiController extends Controller
{
    public function getAllContacts(){
        $contacts=Contact::get()->toJson(JSON_PRETTY_PRINT);
        return response($contacts,200);
    }
    public function createContact(Request $request){
        $contact=new Contact([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'job_title'=>$request->get('job_title'),
            'city'=>$request->get('city'),
            'country'=>$request->get('country')
        ]);
        $contact->save();
        return response()->json([
            "message"=>"Contact created"
        ],201);
    }
    public function getContact($id){
        if(Contact::where('id',$id)->exists()){
            $contact=Contact::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($contact,200);
        }
        else{
            return response()->json(["message"=>"Student not found"],404);
        }
    }
    public function updateContact(Request $request,$id){
        if(Contact::where('id',$id )->exists()) {
            $contact=Contact::find($id);
            $contact->first_name=is_null($request->first_name)?$contact->first_name:$request->first_name;
            $contact->last_name=is_null($request->last_name)?$contact->last_name:$request->last_name;
            $contact->job_title=is_null($request->job_title)?$contact->job_title:$request->job_title;
            $contact->country=is_null($request->country)?$contact->country:$request->country;
            $contact->city=is_null($request->city)?$contact->city:$request->city;
            $contact->save();
            return response()->json(["message"=>"Contact updated successfully"],200);
        }
        else{
            return response()->json(["message"=>"Contact not found"],404);
        }
    }
    public function deleteContact($id){
        if(Contact::where('id',$id)->exists()){
            $contact=Contact::find($id);
            $contact->delete();
            return response()->json(["message"=>"Contact deleted successfully"],200);
        }
        else{
            return response()->json(["message"=>"Contact with such id does not exist"],404);
        }
    }

}
