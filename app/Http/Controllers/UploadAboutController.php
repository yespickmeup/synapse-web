<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class UploadAboutController extends Controller
{
    public function upload(ImageUploadRequest $request){



        if($request->hasFile('image')){
            $imagename = $request->image->getClientOriginalName();
            $request->image->storeAs('public/images/about',$imagename);
            $setting_id = $request->setting_id;
            $setting = \App\Setting::findOrFail($setting_id);
            $setting->about_img = '/images/about/'.$imagename;
            if($setting->save()){
                return $setting;
            }
           
           
        }
        
        // if($request->hasFile('image')){

        //     $image       = $request->file('image');
        //     $filename    = $image->getClientOriginalName();

        //     $image_resize = Image::make($image->getRealPath());              
        //     $image_resize->resize(1000, 500);
        //     $image_resize->save('public/images/banners/' .$filename);

            

        //     $banner_id = $request->banner_id;
        //     $banner = \App\Banner::findOrFail($banner_id);
        //     $banner->banner_img = '/images/banners/'.$filename;
        //     $banner->save();
        //     return back();
        // }

        return response()->json(['message:'=>'failed to upload','image'=>$request->image]);
    }
}
