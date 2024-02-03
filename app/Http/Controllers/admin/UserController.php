<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Phase;
use App\Models\Membership;
use App\Models\Part;
use App\Models\Lesson;
use DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function user(Request $request)
    {
        if($request->ajax()){
          $user = User::where('role','=','1')->where('is_deleted','0')->orderBy('id','DESC')->get();
          return datatables()->of($user)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
              $action = '';
    
              $action.= '<a href="'.url('admin/edit_user',$row->id).'"  Value="Edit User">
                <i class="uil uil-edit"></i>
                </a>
              <form action="'.route('admin.user_delete', $row->id).'" style="display: inline;">
                 <input type="hidden" name="_token" value="'.csrf_token().'">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-link text-danger" class="text-danger" href="#" onclick="return confirm(\'Are you sure you want to delete this Phase?\');"  title="Delete Phase" ><i class="uil uil-trash-alt"></i></button>
              </form>';
           return $action;
              
          })
          ->addColumn('membership', function ($row) {
              
              $membershipList = Membership::where('is_deleted','0')->get();
              
              $membership = '';
    
              $membership.= '
              <form id="membershipFrom'.$row->id.'" action="'.route('admin.user_membership').'" method="POST" style="display: inline;">
                 <input type="hidden" name="_token" value="'.csrf_token().'">
                  <input type="hidden" name="_method" value="POST">
                  <input type="hidden" name="id" value="'.$row->id.'">
                  <select name="membership_id" onChange="submitMembership('.$row->id.')" class="form-select">
                    <option value="">Select Membership</option>';
                    
                    foreach($membershipList as $membershipRow) {
                        
                        $selected = ($membershipRow['id'] == $row->membership_id) ? 'selected' : '';
                        
                        $membership .= '<option '.$selected.' value="'.$membershipRow['id'].'" >'.$membershipRow['membership_type'].'</option>';
                    }
                    
                  $membership .= '</select>
              </form>';
           return $membership;
              
          })
          ->rawColumns(['action','membership']) 
          ->make(true);
        }

        return view('admin.user');
    }
    
    
    public function add_user()
    {
        $membershipList = Membership::where('is_deleted','0')->get();
        return view('admin.add_user', compact('membershipList'));
    }

    public function save_user(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
         
        if(User::where('email','=',$request->email)->where('is_deleted','0')->first()) {
        
            return redirect()->route('admin.add_user')->with('error','User already exists.');
        }
         
        $user = new User;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->membership_id = $request->membership_id;
        $user->save();
        
        return redirect()->route('admin.add_user')->with('success','User Added SuccessFully...');
    }

    public function edit_user(Request $request,$id="")
    {
        $phase = Phase::where('is_deleted','0')->get();
        $part = Part::where('is_deleted','0')->get();
        $lesson = Lesson::where('is_deleted','0')->get();
        
        $user = DB::table('users')
            ->select('users.*','memberships.membership_type')
            ->leftjoin('memberships','memberships.id', '=', 'users.membership_id')->where('users.id','=',  $id)->first();
        
        //$user = User::find($id);
        return view('admin.edit_user',compact('user','phase','part','lesson'));
    }

    public function user_delete($id)
    {
        $datadel = User::find($id);
        $datadel->is_deleted = 1;
        $datadel->save();
        return redirect()->route('admin.user')
                      ->with('success','User Delete Successfully');
    }
    
    public function user_membership(Request $request)
    {
        $id = $request->id;
        $membership_id = $request->membership_id;
        
        $user = User::find($id);
        $user->membership_id = $membership_id;
        $user->save();
        return redirect()->route('admin.user')
                      ->with('success','Membership Saved Successfully');
    }
}

