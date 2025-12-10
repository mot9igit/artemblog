<?php

namespace App\Services\Profile;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class Service
{
    public $user;
    public $user_id;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->user_id = Auth::id();
    }

    public function get(){

    }

    /**
     * Обновление профиля
     *
     * @param $data
     * @return bool|\Exception
     */
    public function update($data){
        $user = Auth::user();
        $user_id = Auth::id();
        try{
            DB::beginTransaction();
            if(isset($data['images'])){
                $images = $data['images'];
                $name = md5(Carbon::now() . '_' . $images[0]->getClientOriginalName()) . '.' . $images[0]->getClientOriginalExtension();
                $path = 'images/users/' . $user_id . '/avatars';
                $manager = ImageManager::gd();
                $image = $manager->read($images[0])
                    ->cover(300, 300);
                $imagedata = (string) $image->toJpeg();
                Storage::disk('public')->put($path.'/'.$name, $imagedata);
                $data['avatar'] = '/storage/'.$path.'/'.$name;
                unset($data['images']);
            }
            $response = $user->update($data);
            DB::commit();
            return $response;
        }catch(\Exception $exception){
            DB::rollBack();
            return $exception;
        }
    }
}
