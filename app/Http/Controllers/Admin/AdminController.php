<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\CmsPage;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30'
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'password is required',
            ];

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Hash::check($data['current_pass'], Auth::guard('admin')->user()->password)) {
                if ($data['new_pass'] == $data['confirm_pass']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pass'])]);
                    return redirect()->back()->with('success_message', 'Password Successfully Updated!');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and Retype Password not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your Current Password is Incorrect!');
            }
        }
        return view('admin.update_password');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_pass'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request, Admin $admin)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'admin_name' => 'required|alpha|max:255',
                'mobile' => 'required|numeric',
                'image' =>  'sometimes|image',
            ];

            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.alpha' => 'Valid name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid mobile is required',
                'image.image' => 'Valid Image is Required'
            ];

            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('image')) {
                // Storage::disk('public')->delete($admin->image);
                $ext = $request->file('image')->extension();
                $content = file_get_contents($request->file('image'));
                $filename = Str::random(35);
                $path = "images/$filename.$ext";
                Storage::disk('public')->put($path, $content);
            }
            $admin::where('email', Auth::guard('admin')->user()->email)->update(['name' => $data['admin_name'], 'mobile' => $data['mobile'], 'image' => $path]);
            return redirect()->back()->with('success_message', 'Admin Details Successfully Updated!');
        }
        return view('admin.update_details');
    }

    public function subAdmins()
    {
        $subadmins = Admin::where('type', 'subadmin')->get();
        return view('admin.subadmins.subadmins', compact('subadmins'));
    }

    public function updateSubAdminStatus(Request $request, Admin $admin)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>". print_r($data); die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            $admin::where('id', $data['subadmin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'subadmin_id' => $data['subadmin_id']]);
        }
    }

    public function edit(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Sub Admins";
            $subadmin = new Admin;
            $message = "Sub Admin added Successfully";
        } else {
            $title = "Edit Sub Admins";
            $subadmin = Admin::find($id);
            $message = "Sub Admin updated Sucessfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($id == "") {
                $subadminCount = Admin::where('email', $data['email'])->count();
                if ($subadminCount > 0) {
                    return redirect()->back()->with('error_message', 'Subadmin already exists!');
                }
            }

            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'image' => 'required'
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required',
                'description.required' => 'Page Description is required',
                'image.image'  => 'Valid Image is required'
            ];

            $this->validate($request, $rules, $customMessages);


            if ($request->hasFile('image')) {
                // Storage::disk('public')->delete($admin->image);
                $ext = $request->file('image')->extension();
                $content = file_get_contents($request->file('image'));
                $filename = Str::random(35);
                $path = "images/$filename.$ext";
                Storage::disk('public')->put($path, $content);
            };
            $subadmin->image = $path;
            $subadmin->name = $data['name'];
            $subadmin->mobile = $data['mobile'];
            $subadmin->status = 1;
            if ($id == "") {
                $subadmin->email = $data['email'];
                $subadmin->type =  'subadmin';
            }
            if ($data['password'] != "") {
                $subadmin->password = bcrypt($data['password']);
            }
            $subadmin->save();
            return redirect('admin/subadmins')->with('success_message', 'Sub Admin added Successfully');
        }
        return view('admin.subadmins.add_edit_subadmins', compact('title', 'subadmin'));
    }


    public function destroy($id)
    {
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Sub Admin Deleted Successfully');
    }

    public function updateRole(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo '<pre>'. print_r($data); die;
            AdminsRole::where('subadmin_id', $id)->delete();

            foreach ($data as $key => $value) {
                if (isset($value['view'])) {
                    $view = $value['view'];
                }else{
                    $view = 0;
                }
                if (isset($value['edit'])) {
                    $edit = $value['edit'];
                }else{
                    $edit = 0;
                }
                if (isset($value['full'])) {
                    $full = $value['full'];
                }else{
                    $full = 0;
                }
            }

            $role = new AdminsRole;
            $role->subadmin_id = $id;
            $role->module = $key;
            $role->view_access = $view;
            $role->edit_access = $edit;
            $role->full_access = $full;
            $role->save();
            return redirect()->back()->with('success_message', 'SubAdmin Roles updated sucessfully');
        }
        $subadminsRole = AdminsRole::where('subadmin_id', $id)->get()->toArray();
        $subadminDetails = Admin::where('id', $id)->first()->toArray();
        $title = "Update ".$subadminDetails['name']." SubAdmin Role/Permission";

        return view('admin.subadmins.update_roles', compact('title', 'id', 'subadminsRole'));
    }
}
