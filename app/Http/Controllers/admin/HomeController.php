<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Phase;
use App\Models\Part;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Membership;
use App\Models\Release;
use App\Models\Answer;
use App\Models\AnswerParent;
use App\Models\User;
use DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // dashboard
    public function index()
    {
        $phase =  Phase::count();
        $part =  Part::count();
        $lesson =  Lesson::count();
        $quiz =  Quiz::count();
        $membership =  Membership::count();

        return view('admin.dashboard',compact('phase','part','lesson','quiz','membership'));
    }
    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // membership

    public function Membership(Request $request,$id="")
    {
        $member_edit = [];
        if($request->ajax()){
            
            $query = Membership::where('is_deleted','0')->get();
            
            return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/membership',$row->id).'"  Value="Edit Membership">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.route('admin.membership_delete', $row->id).'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                 <button class="btn btn-link text-danger" class="text-danger" onclick="return confirm(\'Are you sure you want to delete this Membership?\');"  title="Delete Membership" ><i class="uil uil-trash-alt"></i></button>
                </form>';
             return $action; 
                
            })
            ->rawColumns(['action']) 
            ->make(true);
        }
        if($id != ''){
            $member_edit = Membership::find($id);
        } 

        return view('admin.membership',compact('member_edit')); 
    }

// --------------------------------------------------------------------------------------------------------------------------

    // Memberships Start //

    public function Add_Membership(Request $request)
    {
        $validatedData = $request->validate(
        [
          'membership_type' => 'required',
        ]);
        $membership = new Membership;
        $membership->membership_type = $request->membership_type;
        $membership->save();
        return redirect()->route('admin.membership')->with('success','Membership Added Successfully..');
    }     

    public function edit_membership(Request $request, $id)
    {
        $id = $request->id;
        $update = Membership::find($id);
        $update->membership_type= $request->membership_type;
       
        if($update->save())
        {
            return redirect()->route('admin.membership')->with('success', 'Membership Updated Successfully.');
        }
    }

    public function Membership_delete($id)
    {
       $datadel = Membership::find($id);
       $datadel->is_deleted = 1;
       $datadel->save();
       return redirect()->route('admin.membership')
                     ->with('success','Membership delete Successfully.');
    }
    
}