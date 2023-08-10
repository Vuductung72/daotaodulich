<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreatePartnerRequest;
use App\Http\Requests\Admin\CreatePartnersRequest;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderBy('id', 'ASC')->paginate();
        return view('admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePartnersRequest $request)
    {
        try {
            $data = $request->only('name','email', 'phone' , 'address', 'description');
            $data['image'] = $this->uploadFile($request->image);
            if ($request->has('url')) $data['url'] = $request->url;
            Partner::create($data);
            session()->flash('success', 'Thành công');
            return redirect()->route('ad.partner.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Thất bại');
            return redirect()->back();
        }
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
    public function edit(Partner $partner)
    {
        return view('admin.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePartnerRequest $request, Partner $partner)
    {
        try {
            $data = $request->only('name', 'email', 'phone' , 'address' , 'description');
            if ($request->has('url')) $data['url'] = $request->url;
            if ($request->image) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120'
                ]);
    
                $path = $this->uploadFile($request->image);
                $data['image'] = $path;
    
            }
            $partner->update($data);
            session()->flash('success', 'Thành công');
            return redirect()->route('ad.partner.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Thất bại');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        session()->flash('success', 'Thành công');
        return redirect()->route('ad.partner.index');

    }
}
