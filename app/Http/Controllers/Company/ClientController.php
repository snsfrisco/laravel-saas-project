<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\ClientUser;
use Illuminate\Support\Arr;

class ClientController extends Controller
{

	public function index()
    {
        $clients = Client::all();
		return view('company_user.clients.index',compact('clients'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $client_user=ClientUser::where('client_id',$id)->get();
       $clients=Client::find($id);
       return view('company_user.clients.users.index',compact('client_user','clients'));

    }
    public function create()
    {
        $client=null;
		return view('company_user.clients.create',compact('client'));
    }

	public function store(Request $request)
    {
        //Validate inputs
        $request->validate([
            'name' => 'required',
        ]);
		if($request->path_mode == "live" && $request->live_path == ""){
			return back()->with('error', 'Live path url is blank');
		}
        $data = request()->all();
        $data['company_id']=Auth::user()->company_id;
        $data['created_by']=Auth::user()->id;
        $save=Client::create($data);

        if ($save) {
            return redirect()->route('company_user.clients.index')->with('success', 'Client Created Successfully');
        } else {
            return redirect()->route('company_user.clients.index')->with('fail', 'Something went Wrong, failed to create');
        }
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('company_user.clients.edit',compact('client'));
    }
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $data = request()->all();
        $data['updated_by']=Auth::user()->id;
        $client->update($data);
        session()->flash('success',__('Client updated successfully'));
        return redirect()->route('company_user.clients.index')->with('success',__('Client updated successfully'));
    }

    public function user($client_id){
        $client = Client::find($client_id);
        $client_user=null;
        return view('company_user.clients.users.create',compact('client','client_user'));
    }

    public function user_store(Request $request){
        $data = request()->all();
        if(isset($request->password)){
            $data['password'] = bcrypt($request->password);
        }else{
            $data = Arr::except($data, ['password']);
            //$data->except('_token', 'password');
        }
        $data['created_by_id']=Auth::user()->id;
        $data['created_by_type'] = 'App\\Models\\CompanyUser';
        $save=ClientUser::create($data);
        $save->assignRole('Client Admin');
        if ($save) {
            return redirect()->route('company_user.clients.show',$request->client_id)->with('success', 'User Created Successfully');
        } else {
            return redirect()->route('company_user.clients.show',$request->client_id)->with('fail', 'Something went Wrong, failed to create');
        }

    }

    public function user_edit($id){
        $client_user=ClientUser::find($id);
        $client = Client::find($client_user->client_id);
        return view('company_user.clients.users.edit',compact('client','client_user'));

    }

    public function user_update(Request $request, $id){
        $client_user=ClientUser::find($id);
        $data = request()->all();
        if(isset($request->password)){
            $data['password'] = bcrypt($request->password);
        }else{
            $data = Arr::except($data, ['password']);
            //$data->except('_token', 'password');
        }
        $data['updated_by_id']=Auth::user()->id;
        $save=$client_user->update($data);
        if ($save) {
            return redirect()->route('company_user.clients.show',$client_user->client_id)->with('success', 'User Updated Successfully');
        } else {
            return redirect()->route('company_user.clients.show',$client_user->client_id)->with('fail', 'Something went Wrong, failed to create');
        }


    }
    public function user_destroy($id){
        $client_user=ClientUser::findOrFail($id);
        $client_user->delete();
        return redirect()->back()->with('success',__('User deleted successfully'));

    }


}
