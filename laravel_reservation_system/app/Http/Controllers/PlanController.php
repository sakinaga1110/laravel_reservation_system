<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller
{

    public function index()
    {
        $plans = Plan::orderBy('id', 'desc')->get();
        return view('reservation_system.plan.index', [
            'plans' => $plans
        ]);
    }


    public function create()
    {
        return view('reservation_system.plan.create');
    }

    public function store(Request $request)
    {
        // Plan モデルの作成と保存
        $plan = new Plan();
        $plan->title = $request->input('title');
        $plan->detail = $request->input('detail');
        $plan->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imageFile) {
                // ファイル名を一意にするために時間をプレフィックスに使用
                $fileName = time() . '_' . $imageFile->getClientOriginalName();

                // 画像の保存処理を実行
                $imageFile->storeAs('public/images', $fileName); // public/images ディレクトリに保存

                // Image モデルの作成と保存
                $image = new Image();
                $image->plan_id = $plan->id; // Plan モデルと関連付けるため
                $image->image = $fileName; // ファイル名をデータベースに保存
                $image->save();
            }
        }

        return redirect()->route('plan.index')->with('status', '宿泊プラン登録完了');
    }

    public function show(Plan $plan)
    {
        $plan_id = $plan->id;
        $images = Image::where('plan_id', $plan_id)->get();
        return view('reservation_system.plan.show', ['plan' => $plan, 'images' => $images]);
    }



    public function edit(Plan $plan)
    {
        $plan_id = $plan->id;
        $images = Image::where('plan_id', $plan_id)->get();
        return view('reservation_system.plan.edit', ['plan' => $plan, 'images' => $images]);
    }

    public function update(Plan $plan, Request $request)
    {
        $plan->update([
            'title' => $request->input('title'),
            'detail' => $request->input('detail')
        ]);
        $plan->images()->delete();
        if ($request->has('old-image')) {
            foreach ($request->input('old-image') as $old_image) {
                $image = new Image();
                $image->plan_id = $plan->id; // Plan モデルと関連付けるため
                $image->image = $old_image; // ファイル名をデータベースに保存
                $image->save();
            }
        }
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imageFile) {
                // ファイル名を一意にするために時間をプレフィックスに使用
                $fileName = time() . '_' . $imageFile->getClientOriginalName();

                // 画像の保存処理を実行
                $imageFile->storeAs('public/images', $fileName); // public/images ディレクトリに保存

                // Image モデルの作成と保存
                $image = new Image();
                $image->plan_id = $plan->id; // Plan モデルと関連付けるため
                $image->image = $fileName; // ファイル名をデータベースに保存
                $image->save();
            }
        }

        return redirect()->route('plan.index')->with('status', '更新しました');
    }


    public function destroy(Plan $plan)
    {
        Image::where('plan_id',$plan->id)->delete();
        $plan->delete();
        return redirect()->route('plan.index')->with('status', '削除しました');
    }
}