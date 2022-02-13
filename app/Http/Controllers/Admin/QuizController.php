<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quiz;
use App\Http\Requests\quizCreateRequest;
use App\Http\Requests\quizUpdateRequest;


class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $quizzes=quiz::withCount('question');
        if(request()->get('title')){
            $quizzes=$quizzes->where('title','LIKE',"%". request()->get('title'). "%");
        }
        if(request()->get('status')){
            $quizzes=$quizzes->where('status', request()->get('status'));
        }
         $quizzes=$quizzes->paginate(5);


       return view('Admin.quiz.list',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(quizCreateRequest $request)
    {
      quiz::create($request->post());
      return redirect()->route('quizzes.index')->withSuccess('Quiz Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $quiz=quiz::withCount('question')->find($id) ??abort(404,'Quiz Bulunamadı');
       return view ('admin.quiz.edit',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(quizUpdateRequest  $request, $id)
    {
        $quiz=quiz::find($id) ??abort(404,'Quiz Bulunamadı');
        quiz::find($id)->update($request->except(['_method','_token']));
        return redirect()->route('quizzes.index')->withSuccess('Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz=quiz::find($id) ??abort(404,'Quiz Bulunamadı');
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSuccess('Silme Başarılı');
    }
}
