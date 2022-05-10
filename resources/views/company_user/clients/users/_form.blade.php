<div class="row">
<style>
.validate{
    color:red;
}
</style>
    
   
        <div class="col-lg-4">
        <div class="form-group">
         <label>First Name<sup class="validate">*</sup></label>
         <div class="input-group mb-3">
             <input type="text" class="form-control" placeholder="{{__('First Name')}}" name="first_name" id="first_name" value="{{ isset($client_user) ? $client_user->first_name : '' }}" required>
         </div>
        </div>
     </div>
     <div class="col-lg-4">
        <div class="form-group">
         <label>Middle Name</label>
         <div class="input-group mb-3">
             <input type="text" class="form-control" placeholder="{{__('Middle Name')}}" name="middle_name" id="middle_name" value="{{ isset($client_user) ? $client_user->middle_name : '' }}" >
         </div>
        </div>
     </div>
     <div class="col-lg-4">
        <div class="form-group">
         <label>Last Name<sup class="validate">*</sup></label>
         <div class="input-group mb-3">
             <input type="text" class="form-control" placeholder="{{__('Last Name')}}" name="last_name" id="last_name" value="{{ isset($client_user) ? $client_user->last_name : '' }}" required>
         </div>
        </div>
     </div>
     <div class="col-lg-6">
        <div class="form-group">
         <label>Email<sup class="validate">*</sup></label>
         <div class="input-group mb-3">
             <input type="email" class="form-control" placeholder="{{__('Email')}}" name="email" id="email" value="{{ isset($client_user) ? $client_user->email : '' }}" required>
         </div>
        </div>
     </div>
	 <div class="col-lg-6">
	    <div class="form-group">
			 <label>Password @if (!isset($client_user))<sup class="validate">*</sup>@endif</label>
			 <input type="password" class="form-control form-control-sm" placeholder="{{ __('Password') }}"
                name="password" @if (!isset($client_user)) required @endif>
		</div>
	 </div>
     
	 <input type="hidden" name="client_id"  value="{{$client->id}}"/>
</div>
