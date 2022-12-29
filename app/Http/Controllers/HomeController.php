<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientPayment;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $resultMonth = CarbonPeriod::create('2022-01-01', '1 month', Carbon::now());
            $resultYear = CarbonPeriod::create('2022-01-01', '1 year', Carbon::now());
            $clientCount = Client::count();
            $clientInfoMonth = DB::table('clients')
                ->selectRaw("DATE_FORMAT(created_at, '%b-%Y') as month,count(*) as total")
                ->groupBy('month')
                ->get();

                         $userInfoYear = DB::table('users')
                ->selectRaw("DATE_FORMAT(created_at, '%Y') as year ,count(*) as total")
                ->groupBy('year')
                ->get();


            foreach ($resultMonth as $date) {
                $clientMonth[] = $date->format("M-Y");
            }
            foreach ($resultYear as $date) {
                $clientYear[] = $date->format("Y");
            }

            foreach ($clientMonth as $key => $value) {
                $flagUser = false;
                $flagPost = false;
                foreach ($clientInfoMonth as $item) {
                    if ($value == $item->month) {
                        $monthUser[] = $item->total;
                        $flagUser = true;
                    }
                }

                if (!$flagUser)
                    $monthUser[] = 0;
            }
        
            foreach ($clientYear as $key => $value) {
                $flagUser = false;
                foreach ($userInfoYear as $item) {
                    if ($value == $item->year) {
                        $yearUser[] = $item->total;
                        $flagUser = true;
                    }
                }

                if (!$flagUser)
                    $yearUser[] = 0;

            }
            $clientPayments = ClientPayment::where('payment_status', 'pending')->with('client')->get();
            $data = array(
                'month' => $clientMonth,
                'client' => $monthUser,
                'year' => $clientYear,
                'yearUser' => $yearUser,
                'clientCount' => $clientCount,
                'clientPayments' => $clientPayments
            );
            
            return view('home')->with($data);
        } catch(Exception $e){
            return redirect()->route('client.index')->with('error', 'Error in home page.');
        }
    }

    public function profile(){
         try{
            return view('pages.profile.profile');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('home')->with('error', 'Error occured in the view profile picture');
        }
    }

    public function profileStore(Request $request) {
        try{
            $file = $request->file('image') ?? null;
            $user = auth()->user();
            if ($file) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = Str::random(5) . '.' . $extension;
                $path = public_path() . '/assets/images/';
                public_path('/assets/images' . $file . '.png');
                $file->move($path, $filename);
                $user->image = $filename;
            }
            $password = $request->input('password') ?? null;
            $user->password = $password === '' ? $user->password : bcrypt($request->input('password')); 
            $user->save();
            return redirect()->route('profile.index')->with('success', 'Profile Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('home')->with('error', 'Error occured in the store profile picture');
        }
    }
}
