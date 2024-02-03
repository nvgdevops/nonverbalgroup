<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Content;
use App\Models\ContentDetail;
use DB;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function content_list(Request $request)
    {
        if($request->ajax()){
            
            $content = Content::select('id','name','class','template_type')->where('is_deleted','=','0')->orderBy('id','DESC')->get();
              
            return datatables()->of($content)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
                
                $action.= '<a href="'.url('admin/content',$row->id).'"  Value="Edit Content">
                        <i class="uil uil-edit"></i>
                    </a>
                    <form action="'.route('admin.delete_content', $row->id).'" style="display: inline;">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-link text-danger" class="text-danger" href="#" onclick="return confirm(\'Are you sure you want to delete this Content?\');"  title="Delete Content" ><i class="uil uil-trash-alt"></i></button>
                    </form>';
                return $action;
              
            })
            ->rawColumns(['action']) 
            ->make(true);
        }
        return view('admin.content_list');
    }
   
    public function add_content()
    {
        return view('admin.content');
    }
    
    public function edit_content($id="")
    {
        $edit_content = Content::find($id);
        $content_detail = ContentDetail::where('content_id',$id)->where('is_deleted','0')->get();

        $content_data = array();

        foreach($content_detail as $key => $value)
        {
            $content_data[$value->title] = $value->detail;
        }

        return view('admin.content',compact('edit_content','content_data'));
    }

    public function save_content(Request $request)
    {
         $validate = $request->validate([
             'name' => 'required'
         ]);
        $content = new Content;
        
        $content->name = $request->name;
        $content->class = isset($request->class) ? $request->class : '';
        $content->template_type = isset($request->template_type) ? $request->template_type : '';
        $content->is_button = isset($request->is_button) ? 1 : 0;
        $content->button_name = isset($request->button_name) ? $request->button_name : '';
        $content->button_url = isset($request->button_url) ? $request->button_url : '';
        $content->save();
        $content_id = $content->id;
        
        $is_content_detail = 0;
        $title = array();
        $detail = array();
        
        if($content->template_type == 'container') {
            
            $title = isset($request->container_title) ? $request->container_title : array();
            $detail = isset($request->container_detail) ? $request->container_detail : array();
            $is_content_detail = 1;
            
        } else if($content->template_type == 'video') {
            
            $title = isset($request->video_title) ? $request->video_title : array();
            $detail = isset($request->video_detail) ? $request->video_detail : array();
            $is_content_detail = 1;
            
        } else if($content->template_type == 'practice') {
            
            $title = isset($request->practice_title) ? $request->practice_title : array();
            $detail = isset($request->practice_detail) ? $request->practice_detail : array();
            $is_content_detail = 1;
            
        } else if($content->template_type == 'pdf') {
            
            $title = isset($request->pdf_title) ? $request->pdf_title : array();
            $detail = isset($request->pdf_detail) ? $request->pdf_detail : array();
            $is_content_detail = 1;
            
        }
        
        if($is_content_detail == 1) {
            
            foreach($title as $key => $value){
                
                $content_detail = new ContentDetail;
                $content_detail->content_id =  $content_id;
                $content_detail->title = $value;  
                $content_detail->detail = isset($detail["'".$value."'"]) ? $detail["'".$value."'"] : '';
                $content_detail->save();
            }
        }
      
        return redirect()->route('admin.add_content')->with('success','Content Added SuccessFully...');
    }

    public function update_content(Request $request, $id)
    {
        $id = $request->id;
        $update = Content::find($id);
        $update->name= $request->name;
        $update->class = isset($request->class) ? $request->class : '';
        $update->template_type = isset($request->template_type) ? $request->template_type : $update->template_type;
        $update->is_button = isset($request->is_button) ? 1 : 0;
        $update->button_name = isset($request->button_name) ? $request->button_name : '';
        $update->button_url = isset($request->button_url) ? $request->button_url : '';

        if($update->save())
        {
            ContentDetail::where('content_id',$id)->delete();
            
            $is_content_detail = 0;
            $title = array();
            $detail = array();
            
            if($update->template_type == 'container') {
                
                $title = isset($request->container_title) ? $request->container_title : array();
                $detail = isset($request->container_detail) ? $request->container_detail : array();
                $is_content_detail = 1;
                
            } else if($update->template_type == 'video') {
                
                $title = isset($request->video_title) ? $request->video_title : array();
                $detail = isset($request->video_detail) ? $request->video_detail : array();
                $is_content_detail = 1;
                
            } else if($update->template_type == 'practice') {
                
                $title = isset($request->practice_title) ? $request->practice_title : array();
                $detail = isset($request->practice_detail) ? $request->practice_detail : array();
                $is_content_detail = 1;
                
            } else if($update->template_type == 'pdf') {
                
                $title = isset($request->pdf_title) ? $request->pdf_title : array();
                $detail = isset($request->pdf_detail) ? $request->pdf_detail : array();
                $is_content_detail = 1;
                
            }
            
            if($is_content_detail == 1) {
                
                foreach($title as $key => $value){
                    
                    $content_detail = new ContentDetail;
                    $content_detail->content_id =  $id;
                    $content_detail->title = $value;  
                    $content_detail->detail = isset($detail["'".$value."'"]) ? $detail["'".$value."'"] : '';
                    $content_detail->save();
                }
            }
            
            
            return redirect()->route('admin.content_list')->with('success', 'Content Updated successfully.');
        }
    }
    
    public function delete_content($id)
    {
        $datadel = Content::find($id);
        $datadel->is_deleted = 1;
        $datadel->save();
        return redirect()->route('admin.content_list')
                      ->with('success','Content Deleted successfully');
    }
}

