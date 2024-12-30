<?php

namespace App\Http\Controllers\admin;
use App\Models\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->viewprefix='admin.pages.Comment.';
        $this->viewnamespace='admin/pages/Comment';
    }
    public function index()
    {
        //
        $binh_luan=Comment::paginate(10);
        return view($this->viewprefix.'comment',compact('binh_luan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View($this->viewprefix.'create');
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
        //
        $binh_luan= Comment::find($id);
        return View($this->viewprefix.'edit')->with('binh_luan',$binh_luan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $binh_luan = Comment::find($id);
        $data= $request->validate([
            'Trang_Thai' => 'required',
        ]);
       
        if($binh_luan->update($data))
        {
            Session::flash('message', 'successfully!');
        }
        else
            Session::flash('message', 'Failure!');
        return redirect()->route('comment.index');
    }
    public function search(Request $request)
    {
        $binh_luan = Comment::where('Noi_Dung','like','%'.$request->NhapTimKiem.'%')->paginate(5);
        return View($this->viewprefix.'comment', ['binh_luan'=>$binh_luan]);
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
        $binh_luan=Comment::find($id);
        $binh_luan->delete();
        return redirect()->route('comment.index');
    }
  
}
