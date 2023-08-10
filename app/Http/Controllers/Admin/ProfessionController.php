<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateProfessionRequest;
use App\Http\Requests\Admin\UpdateProfessionRequest;
use App\Models\Profession;
use Illuminate\Support\Str;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::paginate(7);
        return view('admin.professions.index',compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.professions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProfessionRequest $request)
    {
        $profession = $request->only('name','status','profession_code');
        $profession['slug'] = Str::slug( $request->name, '-');
        if(!Profession::create($profession)){
            return redirect()->route('ad.profession.index')->with('error', 'Thêm ngành thất bại');
        }
        return redirect()->route('ad.profession.index')->with('success', 'Thêm ngành thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        return view('admin.professions.edit',compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        $data = $request->only('name','status');
        $data['slug'] = Str::slug( $request->name, '-');
        
        if($request->profession_code == $profession->profession_code){
            $profession->update($data);
        }else{
            $request->validate([
                'profession_code' => 'unique:professions',
            ],[
                'profession_code.unique' => 'Mã ngành đã tồn tại',
            ]);
            $data['profession_code'] = $request->profession_code;
            $profession->update($data);
        }

        return redirect()->route('ad.profession.index')->with('success', 'Cập nhật ngành thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
