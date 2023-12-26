<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllBusiness;
use App\Models\SubBusiness;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QuestionType;
use App\Models\Icon;
use App\Models\QuestionTranslation;
use App\Models\OtherQuestion;
use App\Models\SubBusinessTranslation;
use App\Models\WorkLicense;
use Image;
use Validator;
class UpdateQuestionController extends Controller
{

    public function uplodeImage($file,$name)
    {
        if($file != null){
            $image = $file;
            $input['name'] = $image->getClientOriginalName();
            $path = 'images/icons/';
            $destinationPath = 'images/icons/';
            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['name']);
            $name = $path.time().$input['name'];
            $icon = new Icon;
            $icon->icon = $name;
            $icon->save();
            return $icon->id;
        }
    }

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // view business 
    public function viewBusiness()
    {

        $businesses = AllBusiness::with('icons')->get();
        return view('dashboard.update.business',[
            'businesses' => $businesses
        ]);
    }
    // Add business
    public function addBusiness(Request $request)
    {
        $icon = $this->uplodeImage($request->file('icon'),'icon');
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_de,
            ],
            'icon'=> $icon
        ];
        $business = AllBusiness::create($data);
        WorkLicense::create([
            'name' => $request -> name_de,
            'business_id' => $business->id
        ]);
        return redirect()->back()->withErrors('added successfully');
    }
    // update business 
    public function updateBus(Request $request,$id)
    {
        $bus = AllBusiness::find($id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_de,
            ],
        ];
        $bus->update($data);

        $wor_lic = WorkLicense::where('business_id',$id)->first();
        if($wor_lic == null)
        {
            WorkLicense::create([
                'name' => $request -> name_de,
                'business_id' => $id
            ]);
        }else{
            $wor_lic->name = $request->name_de;
            $wor_lic->save();
        }
        return redirect()->back()->withErrors('updated successfully');
    }
    // delete business
    public function deleteBusiness($id)
    {
        $bus = AllBusiness::find($id);
        $bus->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
    // get sub business
    public function subBusiness($id)
    {
        $subs = SubBusiness::where('business_id',$id)->get();
        return view('dashboard.update.sub-business',[
            'subs' => $subs,
            'business_id' => $id
        ]);
    }
    // add sub business
    public function addSubBusiness(Request $request,$id)
    {
        $data = SubBusiness::create([
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_de,
            ],
            'business_id' => $id,
        ]);
        return redirect()->back()->withErrors('added successfully');
    }
    // update sub business
    public function updateSub(Request $request,$id)
    {
        $sub = SubBusiness::find($id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_de,
            ],
            'icon' => 1,

        ];
        $sub->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    // make furnished or not 
    public function makeFurnished($id)
    {
        $sub = SubBusiness::find($id);
        if($sub->is_furnished == 1 ){
            $sub->is_furnished = 0;
        }else{
            $sub->is_furnished = 1;
        }
        
        $sub->save();
        return redirect()->back();
    }
    // delete sub 
    public function deleteSub($id)
    {
        $sub = SubBusiness::find($id);
        $sub->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
    // get questionSub
    public function questionSub($id)
    {
        $sub = SubBusiness::where('id',$id)->first()->business_id;
        // return $sub;
        $questions = Question::with('typeQues')->where('sub_business',$id)->get();
        return view('dashboard.update.questions',[
            'questions' => $questions,
            'sub_id' => $id,
            'sub' => $sub
        ]);
    }
    // add Question 
    public function addQuestion(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'question_en'=> ['required'],
            'question_de'=> ['required'],
            'type'=> ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if($request->type == 4){
            $type = 2;
        }else{
            $type = $request->type;
        }
        $data = Question::create([
            'en' => [
                'question' => $request -> question_en,
            ],
            'de' => [
                'question' => $request -> question_de,
            ],
            'sub_business' => $id,
            'type' => $type,
            'input_type' => $request->input_type,
            'required' => $request->required,
            'enable' => $request->enable,
        ]);
        if($request->type == 4 | $request->type == 5){
            OtherQuestion::create([
                'question_id' => $data->id,
                'icon' => 153,
                'input_type' => $request->input_type,
            ]);
        }
        return redirect()->back()->withErrors('added successfully');

    }
    // updateQuestion
    public function updateQuestion(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'question_en'=> ['required'],
            'question_de'=> ['required'],
            'type'=> ['required'],
        ]);
        $question = Question::find($id);
        if($request->type == 4){
            $type = 2;
        }else{
            $type = $request->type;
        }
        $data = [
            'en' => [
                'question' => $request -> question_en,
            ],
            'de' => [
                'question' => $request -> question_de,
            ],
            'sub_business' => $question->sub_business,
            'type' => $type,
            'input_type' => $request->input_type,
            'required' => $request->required,
            'enable' => $request->enable,
        ];
        $question->update($data);
        if($request->type == 4 | $request->type == 5){
            OtherQuestion::where('question_id',$question->id)->delete();
            OtherQuestion::create([
                'question_id' => $question->id,
                'icon' => 153,
                'input_type' => $request->input_type,
            ]);
        }
        // return $question;
        return redirect()->back();
    }
    // delete question
    public function deleteQues($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
    // get answers 
    public function answerQuestion($id)
    {
        $bus_id = Question::where('id',$id)->first()->sub_business;
        $answers = Answer::with('icon','questions')->where('question_id',$id)->get();
        return view('dashboard.update.answers',[
            'answers' => $answers,
            'question_id' => $id,
            'bus_id' => $bus_id
        ]);
    }
    // add answers
    public function addAnswer(Request $request,$id)
    {
        $icon = $this->uplodeImage($request->file('icon'),'icon');
        $data = Answer::create([
            'en' => [
                'answer' => $request -> answer_en,
            ],
            'de' => [
                'answer' => $request -> answer_de,
            ],
            'question_id' => $id,
            'image' => $icon,
        ]);
        return redirect()->back()->withErrors('added successfully');
    }
    // update answers
    public function updateAnswer(Request $request,$id)
    {
        $answer = Answer::find($id);
        if($request->file('icon')){
            $icon = $this->uplodeImage($request->file('icon'),'icon');
        }else{
            $icon = $answer->image;
        }
        $data = [
            'en' => [
                'answer' => $request -> answer_en,
            ],
            'de' => [
                'answer' => $request -> answer_de,
            ],
            'image' => $icon
        ];
        
        $answer->update($data);
        return redirect()->back();
    }
    // delete answer 
    public function deleteAnswer($id)
    {
        $answer = Answer::find($id);
        $answer->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
