<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{ 

    public function __construct()
    {
        $this->middleware('permission:view posts', ['only' => ['index']]);
        $this->middleware('permission:create posts', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit posts', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete posts', ['only' => ['destroy']]);
        $this->middleware('permission:publish posts', ['only' => ['publish']]);
        $this->middleware('permission:unpublish posts', ['only' => ['unpublish']]);
    }
    //
    public function swap($locale){
      // available language in template array
      $availLocale=['en'=>'en', 'fr'=>'fr','de'=>'de','pt'=>'pt'];
      // check for existing language
      if(array_key_exists($locale,$availLocale)){
          session()->put('locale',$locale);
      }
      return redirect()->back();
    }

    public function publish(int $id){
        echo 'post berhasil dipublish';
    }

    public function unpublish(int $id){
        echo 'post berhasil diunpublish';
    }
    public function edit(int $id){
        echo 'edit berhasil edit';
    }
    public function destroy(int $id){
        echo 'destroy berhasil destroy';
    }


}
