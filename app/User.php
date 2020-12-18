<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function add($filds,$images)
    {
        $post = new static;
        $post->fill($filds);
        $post->uploadeImage($images);
        $post->password = Hash::make($filds['password']);
        $post->role = 'admin';
        $post->save();
    }
    public function edit($filds,$images)
    {
        $this->fill($filds); 
        $this->uploadeImage($images);
        $this->password = Hash::make($filds['password']);
        $this->role = 'admin';
        $this->save();
    }
    public function uploadeImage($image)
    {
        if ($image == null) {return;}
        $fileNime = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads/user/',$fileNime);
        $this->image = $fileNime;
        $this->save();
    }
    public function getImage()
    {
        if($this->image == null)
        {
            return 'themes/backend/image/default.png';
        }
        return '/uploads/user/' . $this->image;
    }
    public static function deleteImage($image)
    {
        if($image!='') {
            Storage::delete('/uploads/user/'.$image);
        }
    }
}
