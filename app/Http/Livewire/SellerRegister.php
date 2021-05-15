<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\StoreDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerRegister extends Component
{
    public $currentStep = 1;
    public $name, $email, $phone, $seller_type, $password, $password_confirmation, $store_title, $address1, $address2, $city, $state, $country, $post_code, $status = 1;
    public $successMsg = '';

    public function render()
    {
        return view('livewire.seller-register');
    }

    /**
     * Write code on Method
     */
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'seller_type' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'store_title' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'post_code' => 'required'
        ]);

        $this->currentStep = 3;
    }

    /**
     * Write code on Method
     */
    public function submitForm()
    {
        $user_details = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        if ($user_details) {
            $store_details = StoreDetails::create([
                'store_title' => $this->store_title,
                'seller_type' => $this->seller_type,
                'address1' => $this->address1,
                'address2' =>  $this->address2,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'post_code' =>   $this->post_code,
                'status' => 1,
                'user_id' => $user_details->id,
            ]);
        }


        $this->successMsg = 'Store successfully created.';


       $this->clearForm();

       $this->currentStep = 1;
    }

    /**
     * Write code on Method
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     */
    public function clearForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->seller_type = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->store_title = '';
        $this->address1 = '';
        $this->address2 = '';
        $this->city = '';
        $this->state = '';
        $this->country = '';
        $this->post_code = '';
        $this->status = 1;
    }
}
