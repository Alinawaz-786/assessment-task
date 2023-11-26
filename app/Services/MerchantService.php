<?php

namespace App\Services;

use App\Jobs\PayoutOrderJob;
use App\Models\Affiliate;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;

class MerchantService
{
    /**
     * Register a new user and associated merchant.
     * Hint: Use the password field to store the API key.
     * Hint: Be sure to set the correct user type according to the constants in the User model.
     *
     * @param array{domain: string, name: string, email: string, api_key: string} $data
     * @return Merchant
     */
    public function test(){
        dd("Demo");
    }
    public function register(array $data): Merchant
    {
        $user =  new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['api_key'],
        ]);
        $merchant =  new Merchant([
            'user_id' => $user->id,
            'domain' => $data['domain'],
            'display_name' => $data['display_name'],
        ]);
        return $merchant;
        // TODO: Complete this method
    }

    /**
     * Update the user
     *
     * @param array{domain: string, name: string, email: string, api_key: string} $data
     * @return void
     */
    public function updateMerchant(User $user, array $data)
    {
        // TODO: Complete this method
        $UpdateDetails = User::where('id', $user)->first();

        if (is_null($UpdateDetails)) {
            return false;
        }

        if($UpdateDetails ){
            $update = \DB::table('users') ->where('id', $user) ->limit(1) 
            ->update( [ 'name' => $data['name'], 'email' => $data['email'], 'password' => $data['api_key'] ]); 

        }
    }

    /**
     * Find a merchant by their email.
     * Hint: You'll need to look up the user first.
     *
     * @param string $email
     * @return Merchant|null
     */
    public function findMerchantByEmail(string $email): ?Merchant
    {
        // TODO: Complete this method
        $merchant = User::select('users.*','merchants.*')
        ->leftJoin('merchants', 'users.id', '=', 'merchants.user_id')
        ->where('users.email','=',$email);
        return $merchant;
    }

    /**
     * Pay out all of an affiliate's orders.
     * Hint: You'll need to dispatch the job for each unpaid order.
     *
     * @param Affiliate $affiliate
     * @return void
     */
    public function payout(Affiliate $affiliate)
    {
        // TODO: Complete this metho

    $merchant = Affiliate::select('affiliates.*','orders.*')
    ->leftJoin('orders', 'orders.affiliate_id', '=', 'affiliates.id')
    ->where('orders.payout_status','=','unpaid');
    return $merchant;

    }
}
