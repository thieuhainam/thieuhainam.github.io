<?php

namespace Modules\Department\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\Staff\Entities\staff;
use Illuminate\Support\Facades\DB;
class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:department-list|department-create|department-edit|department-delete', ['only' => ['index','store']]);
        $this->middleware('permission:department-create', ['only' => ['create','store']]);
        $this->middleware('permission:department-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
//        $count = DB::table('staff')->count('*')
//        ->groupBy('id_department')->orderBy('id_department')->get() ;

        $department = DB::table('department')->join('staff','staff.id_department','=','department.id')->selectRaw('department.id,department.name,COUNT(*) as sonhanvien')->groupBy('staff.id_department')->get();
//        $department = DB::table('department')->join('staff','staff.id_department','=','department.id')->get();
//        $data = DB::table('staff as T1')
//            ->join('department as T2', function ($join) {
//                $join->on('T1.id_department', '=', 'T2.id');
//            })
//            ->select(array('T1.staff_name', DB::raw('count(*) as sonhanvien')))
//            ->groupby('T1.id_department')->orderBy('id_department')->paginate(30);
            //        dd($department);
        return view('department::index',compact('department'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $staff = staff::all()->where('id_department','=','9');
        return view('department::create',compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Name' => 'required|unique:department|max:255',
        ]);

        $depart = new Department();
//        $depart -> Name = $request -> namedepart;
        $depart->Name = $validatedData["namedepart"];
        $depart ->save();
        $arr=$request->staff_id;

        $id_department = Department::where("Name", "like", $validatedData["namedepart"])->first()->id; // viet ri cho gonj



        for($i=0;$i<count($arr);$i++)
        {
            $staff = staff::where('staff_id' ,$arr[$i])->first();
            $staff->id_department = $id_department;
            $staff->save();
        }

        return redirect()->route('department.a');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {


        $staff = staff::where('id_department',$id)->paginate(10);
        $department = Department::all();
        return view('staff::searchstaff',compact('staff','department','id'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $deparment = DB::table('department')->where('id',$id)->value('Name');
        $staff1 = staff::all()->where('id_department','=',$id);
        $staff = staff::all()->where('id_department','=','9');
        return view('department::addremove',compact('id','staff','staff1','deparment'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $id =1;
        $arr=$request->staff_id;
//        dd($arr);
        $arr1=$request->staff_id1;
//        dd($arr1);

        $id_department = Department::where("id", $id )->first()->id;
        $isInCurrentDepartment = staff::where('id_department', $id_department)->get();
        $isFreeStaff = staff::where('id_department', 9)->get();
        if ($isInCurrentDepartment && $arr) {
            foreach ($isInCurrentDepartment as $staff) {
                if (!in_array( $staff->staff_id, $arr)) {
                    $staff->id_department = 9;
                    $staff->save();
                }
            }
        }

        if ($isFreeStaff && $arr1){
            foreach ($isFreeStaff as $staff) {
                if (in_array($staff->staff_id, $arr1)) {
                    $staff->id_department = $id_department;
                    $staff->save();
                }
            }
        }



//        if ($arr) {
//            for($i=0;$i<count($arr);$i++) {
//                $staff = staff::where('staff_id' ,$arr[$i])->first();
//                $staff->id_department = $id_department;
//                $staff->save();
//            }
//        }
//
//        if ($arr1) {
//            for($i=0;$i<count($arr1);$i++) {
//                $staff = staff::where('staff_id' ,$arr1[$i])->first();
//                $staff->id_department = $id_department;
//                $staff->save();
//            }
//        }

        return redirect()->route('department.a');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $isInCurrentDepartment = staff::where('id_department', $id)->get();
        if ($isInCurrentDepartment) {
            foreach ($isInCurrentDepartment as $staff) {
                $staff->id_department = 9;
                $staff->save();
            }
        }
        Department::where('id', $id)->delete();
        return redirect()->route('department.a');
    }
}
