<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class InquiryController extends Controller
{

    public function index(Request $request)
    {
        $statuses = ['all' => 'すべて', 'not_started' => '未対応', 'in_progress' => '対応中', 'completed' => '対応済'];

        // ステータスフィルター
        $status = $request->get('status_filter', 'all');

        // お問い合わせ一覧を取得する
        if ($request === null || $status === 'all') {
            $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $inquiries = Inquiry::where('status', $status)->orderBy('created_at', 'desc')->paginate(10);
        }
        // クエリパラメータに `status` を追加する
        $request->query->set('status', session('ステータスフィルター'));
        // ステータスフィルターをセッションに保存する
        session()->put('status_filter', $status);

        return view('reservation_system.inquiry.index', [
            'inquiries' => $inquiries,
            'statuses' => $statuses,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id): View
    {

        $inquiry = Inquiry::find($id);
        $statuses = ['not_started' => '未対応　', 'in_progress' => '対応中　', 'completed' => '対応済　'];
        return view('reservation_system.inquiry.show', [
            'inquiry' => $inquiry,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    // 更新
    public function update(Request $request, Inquiry $inquiry)
    {
        try {
            $inquiry->update([
                'status' => $request->input('status'),
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '更新に失敗しました。']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
