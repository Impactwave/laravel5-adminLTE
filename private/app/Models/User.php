<?php namespace App\Models;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
  use Authenticatable, CanResetPassword;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password', 'created_at', 'updated_at', 'active', 'pending'];
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  public function setPasswordAttribute($password)
  {
    if(Hash::needsRehash($password))
    {
      $this->attributes['password'] = Hash::make($password);
    }
  }
}
