<?php

namespace App\Http\Middleware;

use Closure;
use App\News;

class CheckPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->id;
        $data = News::FindOrFail($id);
    
        if(auth()->user()->isPremium == 1 || auth()->user()->id == $data->user_id || auth()->user()->isAdmin == 1){
            return $next($request);
        }
        else{
            return redirect()->route('user_homepage')->with('premium_error','You are not premium user or not your post!!');
        }
        
    }
}
