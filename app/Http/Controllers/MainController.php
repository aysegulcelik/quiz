<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;
use App\Models\quiz;
use App\Models\answer;
use App\Models\result;
class MainController extends Controller
{
    public function dashboard(){
          $quizzes=quiz::where('status','publish')->withCount('question')->paginate(5);
        return view('dashboard',compact('quizzes'));
    }
       public function quiz($slug){
          $quiz=quiz::whereSlug($slug)->with('question')->first();
        return view('quiz',compact('quiz'));

       }

    public function quiz_detail($slug){
      $quiz=quiz::whereSlug($slug)->with('my_result')->withCount('question')->first() ?? abort(404,'Quiz Bulunamadı');
        return view('quiz_detail',compact('quiz'));
    }
    public function result(Request $request ,$slug){
       $quiz=quiz::with('question')->whereSlug($slug)->first() ?? abort(404,'Quiz Bulunamadı');
        $correct=0;
       foreach ($quiz->question as $questions){
          // echo $questions->id.'-'.$questions->correct_answer.'/'.$request->post($questions->id).'<br>';
        answer::create([

            'user_id'=>auth()->user()->id,
            'question_id'=>$questions->id,
            'answer'=>$request->post($questions->id),

        ]);

        if($questions->correct_answer===$request->post($questions->id)){
            $correct+=1;
        }

       }
     $point=round((100/ count($quiz->question))*$correct);
       $wrong=count($quiz->question)-$correct;
       result::create([
           'user_id'=>auth()->user()->id,
           'quiz_id'=>$quiz->id,
           'point'=>$point,
           'correct'=>$correct,
           'wrong'=>$wrong,
       ]);
       return redirect()->route('quiz_detail',$quiz->slug)->withSuccess("Quiz'i bitirdin.Puanın:".$point);
    }

}
