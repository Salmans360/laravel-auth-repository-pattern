@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="content">
            <div class="row gx-3">
                <div class="col-xxl-12 col-xl-12">

                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="row flex-between-end">
                                <div class="col-auto align-self-center">
                                    <h5 class="mb-0" data-anchor="data-anchor">Edit Dealer</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <form class="row g-3 needs-validation" novalidate="" method="post" action="{{ route('dealer.store') }}">
                                @csrf
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom01">Dealer ID<span class="required-sign">*</span></label>
                                    <input class="form-control" id="validationCustom01" type="number" value="" required="" disabled/>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="first_name">Primary First Name<span class="required-sign">*</span></label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" required="" placeholder="First Name" value="{{ old('first_name') }}"/>
                                    <div class="valid-feedback">Looks good!</div>
                                    @error('first_name')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="last_name">Primary Last Name<span class="required-sign">*</span></label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" required="" placeholder="Last Name" value="{{ old('last_name') }}"/>
                                    <div class="valid-feedback">Looks good!</div>
                                    @error('last_name')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="email">Primary Email<span class="required-sign">*</span></label>
                                    <div class="input-group has-validation">
                                        <input class="form-control" id="email" name="email" type="email" aria-describedby="inputGroupPrepend" required="" placeholder="Email" value="{{ old('email') }}"/>
                                        <div class="invalid-feedback">Please enter valid email</div>
                                        @error('email')
                                            <div class="invalid-feedback error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="password">Password<span class="required-sign">*</span></label>
                                    <input class="form-control" id="password" name="password" type="password" value="" required="" placeholder="Password"/>
                                    <div class="valid-feedback">Looks good!</div>
                                    @error('password')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom01">Office Phone<span class="required-sign">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                          <img src="{{ asset('img/car-x-assets/usa.jpeg') }}" alt="USA Flag" class="flag-icon">+1
                                        </span>
                                        <input class="form-control" type="tel" id="numberField" name="office_phone" placeholder="Office Phone" pattern="\d{10}" maxlength="10" oninput="validateNumberInput(this);" value="{{ old('office_phone') }}" required>
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                    @error('office_phone')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label class="form-label" for="office_address">Office Address<span class="required-sign">*</span></label>
                                    <input class="form-control" id="office_address" name="office_address" type="text" required="" placeholder="Office Address" value="{{ old('office_address') }}"/>
                                    <div class="valid-feedback">Looks good!</div>
                                    @error('office_address')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="office_state">Office State<span class="required-sign">*</span></label>
                                    <select class="form-select" id="office_state" name="office_state" required="">
                                        <option selected="" disabled="" value="">Select...</option>
                                        <option value="AL" {{ old('office_state') == 'AL' ? 'selected' : '' }}>Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                    @error('office_state')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="office_city">Office City<span class="required-sign">*</span></label>
                                    <input class="form-control" id="office_city" name="office_city" type="text" required="" placeholder="Office City" value="{{ old('office_city') }}"/>
                                    <div class="invalid-feedback">Please provide a valid city.</div>
                                    @error('office_city')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="office_zip">Office Zip<span class="required-sign">*</span></label>
                                    <input class="form-control" id="office_zip" name="office_zip" type="number" required="" placeholder="Office Zip" value="{{ old('office_zip') }}"/>
                                    <div class="invalid-feedback">Please provide a valid zip.</div>
                                    @error('office_zip')
                                        <div class="invalid-feedback error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label class="form-label" for="validationCustom01">Appointment Form Configuration</label>
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="scheduler_wait" checked="" style="float: left;" />
                                        <label class="form-check-label" for="flexRadioDefault1">Allow only drop off vehicle</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault2" type="radio" name="scheduler_wait" style="float: left;" />
                                        <label class="form-check-label" for="flexRadioDefault2">Allow both drop off vehicle and wait for vehicle </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-12">
                                    <label class="form-label" for="validationCustom01"><b>MailChimp Form Action:</b></label>
                                    <br>
                                    <label class="form-label" for="validationCustom01">Appointment Request Form</label>
                                    <input class="form-control" id="validationCustom01" name="mailchimp_form_action" type="text" placeholder="Enter the complete URL provided by this dealer's MailChimp account" value="{{ old('mailchimp_form_action') }}"/>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>


                                <div class="col-md-1 mx-width-70">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('home') }}" class="btn btn-danger btn-cancel">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
