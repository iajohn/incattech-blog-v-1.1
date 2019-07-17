<?php

namespace App\Http\Controllers\User;

use Auth;
use App\User;
use CreditCard;
use Stripe\Stripe;
use Carbon\Carbon;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    protected $authUser;
    protected $amount;
    protected $invoiceDesc;
    protected $customerID = "";
    public function __construct(){
        $this->authUser = Auth::user();
        $this->amount = intval(env('AMOUNT'));
        $this->invoiceDesc = "Monthly Payment for DevTv subscription for " . date("F Y");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user   = Auth::user();
        $title  = Auth::user()->username;

        return view('pages.frontend.subscribe.index',compact('user','title'));
    }

    public function paySubscription(Request $request){
        $dt = Carbon::now();
        $hasSubscribe = DB::table("users")
            ->join('subscription', 'users.id', '=', 'subscription.user_id')
            ->where('subscription.user_id', '=', $this->authUser->id)
            ->where('subscription.started_time','<=',$dt)
            ->where('subscription.end_time','>=',$dt)
            ->count();
        if($hasSubscribe == 0){
            $niceNames = array(
                'firstname' => 'First Name',
                'lastname' => 'Last Name'
            );

            $this->validate($request, [
                'lastname' => 'required',
                'firstname' => 'required',
            ], [], $niceNames);

            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $token = $request->input('card_token');
            $email = $this->authUser->email;
            Stripe::setApiKey(env('STRIPE_SK'));

            if($this->authUser->stripe_customer_id == ""){
                try {
                    $customer = \Stripe\Customer::create([
                        'source' => $token,
                        'email' => $email,
                        'metadata' => [
                            "First Name" => $firstname,
                            "Last Name" => $lastname
                        ]
                    ]);
                } catch (\Stripe\Error\Card $e) {
                    return redirect()->back()->withInput()->withErrors($e->getMessage());
                }
                $this->customerID = $customer->id;
                $this->updateUserStripeID();
            } else {
                $this->customerID = $this->authUser->stripe_customer_id;
            }

            //print_r($this->authUser);

            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $this->amount,
                    'currency' => 'usd',
                    'customer' => $this->customerID,
                    'metadata' => [
                        'product_name' => $this->invoiceDesc
                    ]
                ]);
            } catch (\Stripe\Error\Card $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }

            // Create subscription record in the database
            $this->addStripePurchase($this->amount, 0, $charge->id, Carbon::now(),
                Carbon::now()->toDateString(), Carbon::now()->addDays(30)->toDateString());

            return redirect()->route('user.subscribe.user')->with('info', 'Your Subscription was successfully');

        } else {
            return redirect()->back()->withErrors("Your subscription is still active!");
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
