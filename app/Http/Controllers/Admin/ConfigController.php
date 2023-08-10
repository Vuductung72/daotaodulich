<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateConfigRequest;
use App\Http\Requests\Admin\UpdateConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $configs = Config::orderBy('id', 'DESC')->paginate();
        return view('admin.configs.index', compact('configs'));
    }

    public function create()
    {
        return view('admin.configs.create');
    }

    public function store(CreateConfigRequest $request)
    {
        $data = $request->only('key', 'value');
        Config::create($data);
        session()->flash('success', 'Thành công');

        return redirect()->route('ad.config.index');
    }

    public function edit(Config $config)
    {
        return view('admin.configs.edit', compact('config'));
    }

    public function update(UpdateConfigRequest $request, Config $config)
    {
        $config->update([
            'value' => $request->value
        ]);
        session()->flash('success', 'Thành công');

        return redirect()->route('ad.config.index');
    }

    public function destroy(Config $config)
    {
        $config->delete();
        session()->flash('success', 'Thành công');

        return redirect()->route('ad.config.index');
    }
}
