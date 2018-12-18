<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class verification
{
    protected $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $name = $request->name;
        $password = $request->password;
        $check_password =  $this->users->get_Password($name);
        if(Hash::needsrehash($check_password[0]->password)){
            echo '需要更新Hash';
        }else{
            echo '不需要Hash';
        }
        if(!Hash::check($password, $check_password[0]->password)){
//            return redirect('Index/Index/login');
        }
        return $next($request);
    }
}
