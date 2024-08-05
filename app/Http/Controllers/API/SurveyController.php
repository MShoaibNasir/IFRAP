<?php

namespace App\Http\Controllers\API;



use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class SurveyController extends BaseController
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User register successfully.');
    }


    // public function survey_form(Request $request)
    // {
    //     // first of all get question title
    //     $question_titles = DB::table('question_title')->get();
    //     $questions = [];
    //     foreach ($question_titles as $qt) {
    //         // then  get question 
    //         $questions_list = DB::table('question')->where('question_title_id', $qt->id)->get();
    //         foreach ($questions_list as $q) {
    //             // then  get options 
    //             $options = DB::table('options')->where('question_id', $q->id)->get();
    //             if (count($options) == 0) {
    //                 $q->options = null;
    //             } else {
    //                 $q->options = $options;
    //             }
    //             $sub_questions = [];
    //             foreach ($options as $opt) {
    //                 // then  get sub_question of that options 
    //                 $sub_questions = DB::table('sub_questions')->where('option_id', $opt->id)->get();
    //                 $opt->sub_questions = $sub_questions;
    //                 foreach ($sub_questions as $sub_ques) {
    //                     // then  get again options of that sub_question 
    //                     $sub_ques_options = DB::table('options')->where('sub_question_id', $sub_ques->id)->get();
    //                     $sub_ques->options = $sub_ques_options;
    //                     // not at the last i get sub question of that options
    //                     foreach ($sub_ques_options as $sqo) {
    //                         $final_questions = DB::table('sub_questions')->where('option_id', $sqo->id)->get();
    //                         $sqo->question = $final_questions;
    //                     }


    //                 }
    //             }
    //         }
    //         $questions[$qt->name] = $questions_list;
    //     }

    //     return $questions;

    // }

    











}

