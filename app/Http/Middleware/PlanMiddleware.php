<?php

namespace App\Http\Middleware;

use App\Models\Planning;
use Closure;
use Illuminate\Http\Request;

class PlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $client_id = $request->input('client_id') ?? null;
        $plan_start_date = $request->input('plan_start_date') ?? null;
        $plan_end_date = $request->input('plan_end_date') ?? null;
        $planning = Planning::where('client_id', $client_id)->whereBetween('plan_start_date', [$plan_start_date, $plan_end_date])
            ->whereBetween('plan_end_date', [$plan_start_date, $plan_end_date])->get();
            if($planning){
            return redirect()->route('planning.index')->with('error', 'Planning is already available. Please choose other date');
            }
        
        return $next($request);
    }
}
