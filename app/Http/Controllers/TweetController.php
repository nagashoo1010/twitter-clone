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
        $tweets = [];
        // var_dump($tweets);
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
