<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
class AnswersController extends Controller
{

    public function store(Question $question, Request $request)
    {
      ;
        $question->answers()->create(  $request->validate([
            'body' => 'required'
          ]) + ['user_id' => \Auth::id()]);
        return back()->with('success', "Your answer has been submitted successfully");
    }


    public function edit(Question $question, Answer $answer)
    {
      $this->authorize("update", $answer);
          return view("answers.edit", compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
      $this->authorize("update", $answer);
        $answer->update($request->validate([
          'body' =>'required',
        ]));
        return redirect()->route('questions.show', $question->slug)->with('success, "Your answer has been published"');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();
        return back()->with('success', 'Your answer has been removed');
    }
}
