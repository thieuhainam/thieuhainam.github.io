<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Staff\Entities\staff;
use Modules\Staff\Entities\department;
use Spatie\Permission\Models\Role;
use Hash;
use Yajra\DataTables\Contracts\DataTable;
use DataTables;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    function __construct()
    {
        $this->middleware('permission:staff-list|staff-create|staff-edit|staff-delete', ['only' => ['index','store']]);
        $this->middleware('permission:staff-create', ['only' => ['create','store']]);
        $this->middleware('permission:staff-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:staff-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $staff = staff::all(); //sao day cai nay get ten giong search ay ma khong hieu sao no khong get duoc vl, m
        $department = department::all();
        //$name = department::all()->where('id',$id)->get('Name');

//        return view('staff::index',compact('staff','department'));
        return view('staff::index',compact('staff','department'));
    }
//    function getdata()
//    {
//        $staff = staff::all();
//        return DataTables::of($staff)->make(true);
//    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $department = department::all();
        return view('staff::addstaff',compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
//        DB::insert('insert into staff (staff_name,id_department) values (?, ?)', [$request-> namestaff,	$request->input('TenDanhSach')	]);
//
        $validatedData = $request->validate([
            'namestaff' => 'required|max:255',
            'sodienthoai' => 'required',
            'address'=> 'required',
        ]);
           $staffs = new staff();
           $staffs -> staff_name = $request -> namestaff;
           $staffs -> phone = $request -> sodienthoai;
           $staffs -> address = $request -> address;
           $staffs -> is_active = $request-> input('active');
           $staffs -> id_department = $request-> input('TenDanhSach');
           $staffs ->save();
//         return call('Modules\Staff\Http\Controllers\StaffController@index');
           return redirect()->route('staff.a');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Request $request)
    {
        if($request-> name == 0 && $request->namesearch==null)
        {
            return redirect()->route('staff.a');
        }
        elseif ($request-> name == 0 && $request->namesearch != null)
        {
            $se_staffname = $request->namesearch;
            $id_de = $request->name;
            $staff = staff::query()->where('staff_name','like',"%{$se_staffname}%")->paginate(5);
            $department = department::all();
            return view('staff::searchstaff',compact('staff','department','id_de','se_staffname'));
        }
           elseif($request-> name != 0 && $request->namesearch == null) {
               $se_staffname = $request->namesearch;
               $id_de = $request->name;
               $staff = staff::where('id_department',$id_de)->paginate(10);
               $department = Department::all();
               return view('staff::searchstaff',compact('staff','department','id_de','se_staffname'));
           }
        else
        {
            $se_staffname = $request->namesearch;
            $id_de = $request->name;
            $staff = staff::query()->where('id_department',$id_de)->where('staff_name','like',"%{$se_staffname}%")->paginate(5);
            $department = Department::all();
            return view('staff::searchstaff',compact('staff','department','id_de','se_staffname'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {try {
        $staff = staff::findOrFail($id);
        $department = department::all();
        return view('staff::updatestaff',compact('staff','department'));
    } catch (ModelNotFoundException $e) {
        echo $e->getMessage();
    }

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'namestaff' => 'required|max:255',
            'sodienthoai' => 'required',
            'address'=> 'required',
        ]);
        $staff = staff::find($id);
        $staff -> staff_name = $request -> namestaff;
        $staff-> phone = $request->sodienthoai;
        $staff-> address = $request->address;
        $staff -> id_department = $request-> input('TenDanhSach');
        $staff -> is_active = $request-> input('active');
        $staff ->save();
        return redirect()->route('staff.a')
            ->with('success','Staff updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($staff_id,$pid,Request $request)
    {
        $staff = staff::all();
        staff::find($staff_id)->delete();
        if($pid == 0)
        {        return redirect()->route('staff.a')
            ->with('success','Staff deleted successfully');}
        else
            return $this->show($request);
    }
}
