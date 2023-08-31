<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Dotenv\Validator;
use Illuminate\Http\Request;


class TweetController extends Controller
{
    // Tweet一覧表示機能 ------------------------------
    public function index()
    {
        $tweets = Tweet::getAllOrderByUpdated_at();
        // dd($tweets);
        return view(('tweet.index') , compact('tweets'));
    }

    // Tweet投稿画面表示 ------------------------------
    public function create()
    {
        return view('tweet.create');
    }

    // Tweet新規投稿機能 ------------------------------
    public function store(Request $request)
    {
        //バリデーション
        // $validator = Validator::make($request->all(), [
        //     'tweet' => 'required | max:191' ,
        //     'description' => 'required',
        // ]);
        // //バリデーションエラーを出す
        // if($validator->fails()) {
        //     return redirect()->route('tweet.create')->withInput()->withErrors($validator);
        // }

        $result = Tweet::create($request->all());
        return redirect()->route('tweet.index');
    }

    //Tweet詳細画面の表示-------------------------------
    public function show(string $id)
    {
        $tweet = Tweet::find($id);
        return view('tweet.show',compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tweet = Tweet::find($id);
        return view('tweet.edit' , compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    //Tweet削除機能-------------------------------
    public function destroy(string $id)
    {
        $result = Tweet::find($id)->delete();
        return redirect()->route('tweet.index');
    }
}
