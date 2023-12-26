<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlackList;
class BlackListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function blackList(){
        $words = BlackList::all();
        return view('dashboard.black-list.blackList',compact('words'));
    }
    public function addWord(Request $request){
        $data = [
            'name' => $request->word
        ];
        BlackList::create($data);
        return redirect()->back()->withErrors('A word has been added to the blacklist');
    }
    public function updateWord(Request $request,$word_id){
        $word = BlackList::find($word_id);
        $data = [
            'name'=> $request->word,
        ];
        $word->update($data);
        return redirect()->back()->withErrors('The blacklist has been modified');
    }
    public function deleteWord($word_id){
        $word = BlackList::find($word_id)->delete();
        return redirect()->back()->withErrors('The word has been removed from the blacklist');
    }
}
