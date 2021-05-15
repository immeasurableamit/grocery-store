<div>
    @if(!empty($successMsg))
    <div class="alert alert-success">
        {{ $successMsg }}
    </div>
    @endif
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="multi-wizard-step">
                <a href="#step-1" type="button"
                    class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                <p>Basic Details</p>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-2" type="button"
                    class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                <p>Store Details</p>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-3" type="button"
                    class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}"
                    disabled="disabled">3</a>
                <p>Confirm Details</p>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">

        <div class="col-md-12">
            <h3> Basic Details</h3>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Seller Name:</label>
                  <input type="text" class="form-control" id="name" wire:model="name">
                  @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" wire:model="email">
                  @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="phone">Phone:</label>
                  <input type="text" class="form-control" id="phone" wire:model="phone">
                  @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-md-6">
                  <label for="seller_type">Seller Type:</label>
                  <select class="form-control" id="seller_type" wire:model="seller_type">
                    <option value="">Select Seller Type</option>
                    <option value="Retailer">Retailer</option>
                    <option value="Wholesaler">Wholesaler</option>
                    <option value="Manufacturer">Manufacturer</option>
                  </select>
                  @error('seller_type') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" wire:model="password">
                  @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-md-6">
                  <label for="password_confirmation">Confirm Password</label>
                  <input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation">
                  @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>


            {{-- <div class="form-group">
                <label for="detail">Team Details:</label>
                <textarea type="text" wire:model="detail" class="form-control"
                    id="taskDetail">{{{ $detail ?? '' }}}</textarea>
                @error('detail') <span class="error">{{ $message }}</span> @enderror
            </div> --}}
            <button class="btn btn-primary nextBtn pull-right" wire:click="firstStepSubmit"
                type="button">Next</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
        <div class="col-md-12">
            <h3> Store Details </h3>

            <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="store_title">Store Title:</label>
                  <input type="text" class="form-control" id="store_title" wire:model="store_title">
                  @error('store_title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address1">Address 1</label>
                    <input type="text" class="form-control" id="address1" wire:model="address1">
                    @error('address1') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>

                  <div class="form-group col-md-6">
                      <label for="address2">Address 2</label>
                      <input type="text" class="form-control" id="address2" wire:model="address2">
                      @error('address2') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" wire:model="city">
                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>

                  <div class="form-group col-md-6">
                      <label for="country">Country</label>
                      <input type="text" class="form-control" id="country" wire:model="country">
                      @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" wire:model="state">
                    @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>

                  <div class="form-group col-md-6">
                      <label for="post_code">Post Code</label>
                      <input type="text" class="form-control" id="post_code" wire:model="post_code">
                      @error('post_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
            </div>


            <button class="btn btn-primary nextBtn pull-right" type="button"
                wire:click="secondStepSubmit">Next</button>

            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(1)">Back</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
        <div class="col-md-12">
            <h3> Confirm Details</h3>
            <table class="table">
                <tr>
                    <td>Seller Name::</td>
                    <td><strong>{{$name}}</strong></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><strong>{{$email}}</strong></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><strong>{{$phone}}</strong></td>
                </tr>
                <tr>
                    <td>Seller Type:</td>
                    <td><strong>{{$seller_type}}</strong></td>
                </tr>

                <tr>
                    <td>Store Title:</td>
                    <td><strong>{{$store_title}}</strong></td>
                </tr>

                <tr>
                    <td>Address 1:</td>
                    <td><strong>{{$address1}}</strong></td>
                </tr>

                <tr>
                    <td>Address 2:</td>
                    <td><strong>{{$address2}}</strong></td>
                </tr>

                <tr>
                    <td>City:</td>
                    <td><strong>{{$city}}</strong></td>
                </tr>

                <tr>
                    <td>Country:</td>
                    <td><strong>{{$country}}</strong></td>
                </tr>

                <tr>
                    <td>State:</td>
                    <td><strong>{{$state}}</strong></td>
                </tr>

                <tr>
                    <td>Post Code:</td>
                    <td><strong>{{$post_code}}</strong></td>
                </tr>
            </table>
            <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(2)">Back</button>
        </div>
    </div>
</div>
