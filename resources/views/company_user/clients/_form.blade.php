<div class="row">
<style>
.validate{
    color:red;
}
</style>
    <div class="col-lg-12">
        <div class="form-group">
            <label>Client<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('Client')}}" name="name" id="name" value="{{ isset($client) ? $client->name : '' }}" required>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Address<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('Address')}}" name="address" id="address" value="{{ isset($client) ? $client->address : '' }}" required>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>City<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('City')}}" name="city" id="city" value="{{ isset($client) ? $client->city : '' }}" required>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>State<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('State')}}" name="state" id="state" value="{{ isset($client) ? $client->state : '' }}" required>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Zip<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('Zip code')}}" maxlength="6" name="zip" id="zip" value="{{ isset($client) ? $client->zip : '' }}" required>
            </div>
        </div>
    </div>
    <legend>Contact Person Information</legend>


    <div class="col-lg-4">
        <div class="form-group">
            <label>First Name<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('First Name')}}" name="first_name" id="first_name" value="{{ isset($client) ? $client->first_name : '' }}" required>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label>Middle Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('Middle Name')}}" name="middle_name" id="middle_name" value="{{ isset($client) ? $client->middle_name : '' }}">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label>Last Name<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('Last Name')}}" name="last_name" id="last_name" value="{{ isset($client) ? $client->last_name : '' }}" required>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Email<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="{{__('Email')}}" name="email" id="email" value="{{ isset($client) ? $client->email : '' }}" required>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Phone Number<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="tel" class="form-control" placeholder="{{__('Phone Number')}}" name="phone_number" id="phone_number" value="{{ isset($client) ? $client->phone_number : '' }}" required>
            </div>
        </div>
    </div>



    {{-- <div class="col-lg-6">
        <div class="form-group">
            <label for="inputClientCompany">Link with Society<i class="text-danger mr-5">*</i></label>
            <input type="hidden" name="path_mode" value="No" />
            <input type="checkbox" {{ (isset($client) && ($client->path_mode=='Yes')) ? 'checked' : '' }} name="path_mode" id="path_mode" value="No" data-toggle="toggle" data-onstyle="success" data-on="Yes" data-off="No">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>Society API endpoint url<sup class="validate">*</sup></label>
            <div class="input-group mb-3">
                <input type="tel" class="form-control" placeholder="{{__('Phone Number')}}" name="phone_number" id="phone_number" value="{{ isset($client) ? $client->phone_number : '' }}" required>
            </div>
        </div>
    </div> --}}

	<div class="col-lg-12">
		<fieldset style="border: 1px solid;padding: 0 10px;margin-bottom:20px;">
			<legend style="width:auto;padding:0 10px;">Link with Society:</legend>
			<div class="form-group">
                <label for="inputClientCompany">Link with Society<i class="text-danger mr-5">*</i></label>
                <input type="hidden" name="path_mode" id="path_mode_switch" value="No" />
                <input type="checkbox" {{ (isset($client) && ($client->path_mode=='Yes')) ? 'checked' : '' }} name="path_mode" id="path_mode" value="Yes"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Yes" data-off="No">
            </div>
			<div class="form-group {{isset($client) ? ($client->path_mode == 'Yes' ? '' : 'd-none' ) : 'd-none' }}" id="live_path_div">
                <label>Society API endpoint url<sup class="validate">*</sup></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="{{__('')}}" name="live_path" id="live_path" value="{{ isset($client) ? $client->live_path : '' }}" />
                </div>
            </div>
		</fieldset>
	</div>
	{{-- <div class="col-lg-12">
		<fieldset style="border: 1px solid;padding: 0 10px;margin-bottom:20px;">
			<legend style="width:auto;padding:0 10px;">URL Setup:</legend>
			<div class="form-group">
				<label for="inputClientCompany">Live URL Path</label>
				 <input name="live_path" id="live_path" value="{{ isset($client) ? $client->live_path : '' }}" type="text" class="form-control live">
			</div>
			<div class="form-group">
				<label for="inputClientCompany">Sandbox URL Path<i style="color: red;">*</i></label>
				<input name="sandbox_path" id="sandbox_path" value="{{ (isset($client) && ($client->sandbox_path != '')) ? $client->sandbox_path : url('/') }}" type="text" class="form-control sand" required>
			</div>
		</fieldset>
	</div> --}}

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet">
<script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>


