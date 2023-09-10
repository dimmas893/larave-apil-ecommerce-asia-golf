<?php
namespace App\Services\Auth;
 
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use GuzzleHttp\json_decode;
use phpDocumentor\Reflection\Types\Array_;
use Illuminate\Contracts\Auth\Authenticatable;
 
class HeaderGuard implements Guard
{
  protected $request;
  protected $provider;
  protected $user;
 
  /** 
* Create a new authentication guard. 
* 
* @param \Illuminate\Contracts\Auth\UserProvider $provider 
* @param \Illuminate\Http\Request $request 
* @return void 
*/
  public function __construct(Request $request)
  {
    $this->request = $request;
    $this->user = NULL;
  }
 
  /** 
* Determine if the current user is authenticated. 
* 
* @return bool 
*/
  public function check()
  {
    return ! is_null($this->user());
  }
 
  /** 
* Determine if the current user is a guest. 
* 
* @return bool 
*/
  public function guest()
  {
    return ! $this->check();
  }
 
  /** 
* Get the currently authenticated user. 
* 
* @return \Illuminate\Contracts\Auth\Authenticatable|null 
*/
  public function user()
  {
    $user_id = $this->request->header('x-user');
    return $user_id;
  }
 
  /** 
* Get the ID for the currently authenticated user. 
* 
* @return string|null 
*/
  public function id()
  {
    return $this->id;
  }
 
  /** 
* Validate a user's credentials. 
* 
* @return bool 
*/
  public function validate(Array $credentials=[])
  {
    return false;
  }
 
  /** 
* Set the current user. 
* 
* @param Array $user User info 
* @return void 
*/
  public function setUser(Authenticatable $user)
  {
    return $user;
  }
}