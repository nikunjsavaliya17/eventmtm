<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $configurations = Configuration::all();
        return view('configurations.index', compact('configurations'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->except('_token');
        foreach ($requestData['configurations'] as $identifier => $value){
            Configuration::where('identifier', $identifier)->update([
               'value' => $value
            ]);
        }
        return to_route('configuration.index')->with('success', 'Data Updated Successfully');
    }
}
