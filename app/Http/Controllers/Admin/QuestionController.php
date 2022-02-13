<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quiz;
use App\Http\Requests\questionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use function Livewire\str;
use Illuminate\Support\Str;
use App\Models\question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

     $quiz = quiz::whereId($id)->with('question')->first() ?? abort(404,'Quiz Bulunamadı');

        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       $quiz=quiz::find($id);
        return view('admin/question/create',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(questionCreateRequest $request,$id)
    {
            if($request->hasFile('image')){
                $fileName=Str::slug($request->question).'.'.$request->image->extension();
                $fileNameWithUpload= 'uploads/'.$fileName;
                $request->image->move(public_path('uploads'),$fileName);
                $request->merge([
                    'image'=>$fileNameWithUpload]);
            }


            quiz::find($id)->question()->create($request->post());
        return redirect()->route('question.index',$id)->withSuccess('Soru Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id,$question_id)
    {
        $question= quiz::find($quiz_id)->question()->whereId($question_id)->first() ?? abort(404,('yok'));
         return view('admin.question.edit',compact('question'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest  $request, $quiz_id,$question_id)
    {
      if($request->hasFile('image')){
            $fileName=Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload= 'uploads/'.$fileName;
            $request->image->move(public_path('uploads'),$fileName);
            $request->merge([
                'image'=>$fileNameWithUpload]);
        }


        quiz::find($quiz_id)->question()->whereId($question_id)->first()->update($request->post());
        return redirect()->route('question.index',$quiz_id)->withSuccess('Soru Güncellendi');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id,$question_id)
    {
       quiz::find($quiz_id)->question()->whereId($question_id)->delete();
        return redirect()->route('question.index',$quiz_id)->withSuccess('Soru Silindi');
    }
}
