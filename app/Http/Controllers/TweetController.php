<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request){
    // バリデーション
    // $validator = Validator::make($request->all(), [
    //     'tweet' => 'required | max:191',
    //     'description' => 'required',
    // ]);
    // // バリデーション:エラー
    // if ($validator->fails()) {
    //     return redirect()->route('tweet.create')->withInput()->withErrors($validator);
    // }

    // $data = $request->merge(['user_id' => Auth::user()->id])->all();
    // dd($data);
    $data = $request->all();
    $data['user_id'] = Auth::user()->id;
    $result = Tweet::create($data);

    // tweet.index」にリクエスト送信（一覧ページに移動）
    return redirect()->route('tweet.index');
    }

    //Tweet詳細画面の表示-------------------------------
    public function show(string $id)
    {
        $tweet = Tweet::find($id);
        return view('tweet.show',compact('tweet'));
    }

    //Tweet編集画面表示-------------------------------
    public function edit(string $id)
    {
        $tweet = Tweet::find($id);
        return view('tweet.edit' , compact('tweet'));
    }

    //Tweet更新機能実装-------------------------------
    public function update(Request $request, string $id){
        // //バリデーション
        // $validator = Validator::make($request->all(), [
        //     'tweet' => 'required | max:191',
        //     'description' => 'required',
        // ]);
        // //バリデーション:エラー
        // if ($validator->fails()) {
        //     return redirect()->route('tweet.edit', $id)->withInput()->withErrors($validator);
        // }

        $result = Tweet::find($id)->update($request->all());
        return redirect()->route('tweet.index');
    }

    //Tweet削除機能-------------------------------
    public function destroy(string $id)
    {
        $result = Tweet::find($id)->delete();
        return redirect()->route('tweet.index');
    }


    // ログイン中のユーザーのIDを取得し、ユーザーに紐づいたTweetを取得、取得したデータを降順に並べて取得し、viewに返す。
    public function mydata(){
        $tweets = User::query()
            ->find(Auth::user()->id)
            ->userTweets()
            ->orderBy('created_at','desc')
            ->get();
        return view('tweet.index', compact('tweets'));
    }
}
