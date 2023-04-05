<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Throwable;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
    $req=request();
    if ($req->ajax()) {
        $strt   = $req->start;
        $length = $req->length;

        $users=User::query();


      if ($req->name != null) {
        $users->where('name','LIKE','%'.$req->name.'%');
      }

      if ($req->email != null) {
        $users->where('email', $req->email);
      }

        $total = $users->count();
        $users   = $users->offset($strt)->limit($length)->get();

            return DataTables::of($users)
                ->setOffset($strt)
                ->with([
                  "recordsTotal"    => $total,
                  "recordsFiltered" => $total,
                ])
                ->addColumn('action', function ($row) {
                    $action='';

                if(Auth::user()->hasRole('super-admin') AND $row->hasRole('super-admin')){
                $action.='<a class="btn btn-primary btn-sm" href="'.url('users/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';

                }
                elseif($row->hasRole('super-admin'))
                {
                    return '';
                }
                    else{
                if(Auth::user()->can('users.edit')){
                $action.='<a class="btn btn-primary m-1 btn-sm" href="'.url('users/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Auth::user()->can('users.delete')){
                $action.='<a class="btn btn-danger m-1 btn-sm" href="'.url('users/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                    }

                }
                return $action;
                })

                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('email', function ($row) {
                    return $row->email;
                })                
                ->editColumn('role', function ($row) {
                    return count($row->roles)>0 ? $row->roles[0]->name : '';
                }) 

                ->editColumn('status', function ($row) {
                    if($row->status==1){
                        return  '<a class="btn btn-success btn-sm" href="'.url('users/status/'.$row->id).'">Active</a>';
                    }
                    else{
                        return  '<a class="btn btn-danger btn-sm" href="'.url('users/status/'.$row->id).'">Deactive</a>';
                    }
                })

                ->rawColumns(['action','role','status'])
                ->make(true);
    }


        return view('users::index');    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['role']=Role::where('name','!=','super-admin')->get();
        return view('users::create')->withData($this->data);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {

        $req->validate([
        'name'=>'required',
        'email'=>['required','unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'role'=>['required'],

        ]);

        DB::beginTransaction();
        try {
            $inputs=$req->except('_token','role');
            $inputs['password']=Hash::make($req->password);
            $inputs['image']='dummy.png';
            $inputs['status']=1;
            $user=User::create($inputs);
            $user->assignRole($req->role);
            DB::commit();
            return redirect('users')->with('success', 'User successfully created');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }
        catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }







    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $this->data['role']=Role::where('name','!=','super-admin')->get();
        $this->data['user']=User::with('roles')->find($id);
        return view('users::edit')->withData($this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $req->validate([
        'name'=>'required',
        'email'=>['required', 'unique:users,email,'.$id],
        'role'=>['required'],
         ]);

       

        DB::beginTransaction();
        try {

            $inputs=$req->except('_token','role');
            if($req->password!=null){
            $inputs['password']=Hash::make($req->password);
            }

            $user=User::find($id);
            $user->update($inputs);
            $user->roles()->detach();
            $user->assignRole($req->role);
            DB::commit();
            return redirect('users')->with('success', 'User successfully updated');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }
        catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }


    }


    public function status($id)
    {
        DB::beginTransaction();
        try {
            $user=User::find($id);
            if($user->status==0){
                $user->status=1;
            }
            else{
                $user->status=0;
            }
            $user->save();
            DB::commit();
            return redirect('users')->with('success', 'User status updated successfully');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }
        catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $user=User::find($id);
            $user->roles()->detach();
            $user->delete();
            DB::commit();
            return redirect('users')->with('success', 'User successfully deleted');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }
        catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }

    }
}
