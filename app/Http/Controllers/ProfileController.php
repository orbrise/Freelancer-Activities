<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;
use Image;
use App\User;
use App\UserDetail;
use App\UserService;
use App\UserCustomform;
use App\Country;
use App\UserImage;

class ProfileController extends Controller
{
	public function userProfileUpdate(Request $req)
    {
        //dd($req->all());
    	$FilterRequest = ['name','lastname', 'email','tagline','country','about','contact_email','phone','address','city','postal_code','profile_img','aemail','aphone','aaddress','acity','apostal','country_name','country_id'];
		$data = $req->only($FilterRequest);
    	$attributes = [
            'name' => 'Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'tagline' => 'Tagline',
            'country' => 'Country',
            'about' => 'About Your self',
            'contact_email' => 'Contact Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'postal_code' => 'Postal Code',
            'profile_img' => 'Profile Image'
        ];
        $validator = Validator::make($data ,[
            'name' => 'required|string|max:100',
            // 'lastname' => 'required|string|max:100',
            'email' => 'required|email',
            // 'tagline' => 'required|string|max:1000',
            // 'country' => 'required|string',
            // 'about' => 'required|string|max:50000',
            // 'contact_email' => 'email',
            // 'phone' => 'required|numeric',
            // 'address' => 'required|string|max:1000',
            // 'city' => 'required|string',
            // 'postal_code' => 'required|numeric'

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

            if(!empty($req->usercustomform)){
                UserCustomform::where('user_id' , Auth::user()->id)->delete();
                 foreach($req->usercustomform as $custf)
            {
            foreach($custf as $col => $v){
                if(is_array($v)){
                    foreach($v as $n){$arraycompost[] = $v;}
                    $v = implode(",",$v);
                } 
                // $newdata[] = array(
                //     'user_id' => Auth::user()->id,
                //     'label' => $col,
                //     'value' =>  $v
                // );
					
                 UserCustomform::updateOrCreate(
                    ['user_id' => Auth::user()->id,'label' => trim($col), 'value' => trim($v)],
                    ['user_id' => Auth::user()->id,'label' => trim($col), 'value' => trim($v)]);
            }  
        }
    }
           

        
        $countryd = Country::where('code', $data['country'])->first();
		$countryname = !empty($countryd) ? $countryd->name : '';
		$countryid = !empty($countryd) ? $countryd->id : '0';
        $userd = UserDetail::where('user_id',Auth::user()->id)->first();
        $user = User::whereId(Auth::user()->id)->update(['name'=>$data['name'],'lastname'=>$data['lastname']]);
        if($user){
        	if($req->hasFile('profile_img'))
	    	{
	    		$file = $req->profile_img;
	    		$ext = $req->file('profile_img')->getClientOriginalExtension();
	            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
	            {
	            	$newnProfileImage = Auth::user()->id.date("His").'.'.$ext;
	                $profileImg = Image::make($file);
	                $profileImg->save('public/assets/images/'.$newnProfileImage, 60);
	                $data['profile_img'] = $newnProfileImage;
	            }
	        } else {$data['profile_img'] = $userd->profile_img;}



	        if(UserDetail::where('user_id',Auth::user()->id)->first()){
	        	$userDetail = UserDetail::where('user_id',Auth::user()->id)->update(['user_id'=>Auth::user()->id, 'tagline' => $data['tagline'],'country' =>$data['country'],'about' =>$data['about'],'contact_email' => $data['contact_email'],'phone' =>$data['phone'],'address' => $data['address'],'city' => $data['city'],'postal_code' => $data['postal_code'],'profile_img' => $data['profile_img'], 'admin_email' => $data['aemail'],'admin_phone' =>$data['aphone'],'admin_address' => $data['aaddress'],'admin_city' => $data['acity'],'admin_zip' => $data['apostal'],'country_name' => $countryname,'country_id' => $countryid]);

	        	if($userDetail){
	            	return redirect()->back()->with('successmsg', ' General Information has been added successfully');
	        	} else {
	            	return redirect()->back()->with('errorsmsg', 'Failed to add General Information has been');
	          }
              
	        }else{
	        	$userDetail = UserDetail::create(['user_id'=>Auth::user()->id, 'tagline' => $data['tagline'],'country' =>$data['country'],'about' =>$data['country'],'contact_email' => $data['contact_email'],'phone' =>$data['phone'],'address' => $data['address'],'city' => $data['city'],'postal_code' => $data['postal_code'],'profile_img' => !empty($data['profile_img'])?$data['profile_img']:'','admin_email' => $data['aemail'],'admin_phone' =>$data['aphone'],'admin_address' => $data['aaddress'],'admin_city' => $data['acity'],'admin_zip' => $data['apostal'],'country_name' => $countryname,'country_id' => $countryid]);
	        	if($userDetail){
	            	return redirect()->back()->with('successmsg', ' General Information has been added successfully');
	        	} else {
	            	return redirect()->back()->with('errorsmsg', 'Failed to add General Information has been');
	        	}
	        }
        } else {
            return redirect()->back()->with('errorsmsg', 'Failed to add General Information');
        }
    }

    public function socialLink(Request $req)
    {
    	// dd($req->all());
    	$FilterRequest = ['website','facebook', 'twitter','instagram','youtube','google','behance','dribble','github','linkedin'];
		$data = $req->only($FilterRequest);
    	$attributes = [
            'website' => 'Website',
            'facebook' => 'Facebook Name',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'youtube' => 'Youtube',
            'google' => 'Google',
            'behance' => 'Behance',
            'dribble' => 'Dribble',
            'github' => 'Github',
            'linkedin' => 'Linkedin',
        ];
        $validator = Validator::make($data ,[
            // 'website' => 'required|string|max:100',
            // 'facebook' => 'required|string|max:100',
            // 'twitter' => 'required',
            // 'instagram' => 'required|string|max:1000',
            // 'youtube' => 'required|string',
            // 'google' => 'required|string|max:50000',
            // 'behance' => 'email',
            // 'dribble' => 'required|numeric',
            // 'github' => 'required|string|max:1000',
            // 'linkedin' => 'required|string',
            // 'postal_code' => 'required|numeric'

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


      
        if(UserDetail::where('user_id',Auth::user()->id)->first()){
        	$userDetail = UserDetail::where('user_id',Auth::user()->id)->update($data);
        	if($userDetail){
            	return redirect()->back()->with('successmsg', ' External links has been added successfully');
        	} else {
            	return redirect()->back()->with('errorsmsg', 'Failed to add External links has been');
        	}

        }else{
        	$data['user_id']=Auth::user()->id;
        	$userDetail = UserDetail::create($data);
        	if($userDetail){
            	return redirect()->back()->with('successmsg', ' External links has been added successfully');
        	} else {
            	return redirect()->back()->with('errorsmsg', 'Failed to add External links has been');
        	}
        }
    }
    public function addService(Request $req)
    {
        // dd($req->all());
        
        $id = $req->input('id');
        $price = $req->input('price');
        $budget_type = $req->input('budget_type');

        $checkUseService = UserService::whereId($id)->first();
        // dd($checkUseService);
       
        $effected = UserService::where('id',$checkUseService->id)->update(['price'=>$price,'budget_type'=>$budget_type]);
        
        $response = array();
        if($effected){
            $response['status']= true;
            $response['price']=$price; 
            $response['budget_type'] = $budget_type; 
            $response['message']="User Service has been update.";
        }else{
            $response['status']= false;
            $response['message']="Oh! Failed to update User Service  .";
        }
        return response()->json($response, 200);

    }

    public function changePassword(Request $req)
    {
    	$FilterRequest = ['old_password','new_password', 'confirm_password'];
		$data = $req->only($FilterRequest);
    	$attributes = [
            'old_password' => 'Currnet Password',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
        ];
        $validator = Validator::make($data ,[
	        'old_password' => 'required|min:6|max:20',
            'new_password' => 'required|min:6|max:20',
            'confirm_password' => 'required|same:new_password',

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $oldPassword = $data['old_password'];
        $newPassword = $data['new_password'];

        $getUser = User::whereId(Auth::user()->id)->first();
        $result = Hash::check($oldPassword, $getUser->password);

        if(!$result){
            return redirect()->back()->with(['errorsmsg' => 'Invalid old password']);
        }

        $passwordUpdate = User::whereId(Auth::user()->id)->update([
            'password' => bcrypt($newPassword),
        ]);

        if(!$passwordUpdate){
            return redirect()->back()->with(['errorsmsg' => 'Failed to update password!']);
        }

        return redirect()->back()->with(['successmsg' => 'Password update successfully!']);

    }
	
	public function Gallary()
	{
		$images = UserImage::where('user_id', Auth::user()->id)->get();
		return view('frontend.pages.userdash.gallary', compact('images'));
	}
	
	public function GallaryPost(Request $req)
	{
		 if(!empty($req->gallary))
    	{

			foreach($req->gallary as $key => $pic) {
    		$ext = $pic->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newimage = rand().date("His").$key.'.'.$ext;
                $finalimage = Image::make($pic);
                $finalimage->save('public/assets/userimages/'.$newimage, 60);
                UserImage::insert(['user_id' => Auth::user()->id, 'image_name' => $newimage]);
            }
		  }
        }
		return redirect()->back()->with(['successmsg' => 'images are uploaded successfully!']);
	}

    public function GallaryDelete($id='')
    {
        $img  = UserImage::find($id);
        unlink(base_path().'/public/assets/userimages/'.$img->image_name);
        UserImage::where('id', $id)->delete();
        return redirect()->back()->with(['successmsg' => 'image has been deleted successfully!']);
    }

    public function GallaryDeleteMultiple(Request $req)
    {
        if(!empty($req->deletimg)){
            foreach($req->deletimg as $imgd){
                $img  = UserImage::find($imgd);
        unlink(base_path().'/public/assets/userimages/'.$img->image_name);
        UserImage::where('id', $imgd)->delete();
            }
            
        return redirect()->back()->with(['successmsg' => 'image has been deleted successfully!']);
        }
        
    }

}

