<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function createService(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'salary' => 'required|numeric',
            'image' => 'required|file|max:4096'
        ]);
        $path = "";
        if($request->hasFile('image')) {
            $path = FileUploadService::uploadImage($request->file('image'), Auth::user()->id, "services"); 
        }
        
        Service::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'salary' => $request->input('salary'),
            'image' => $path
        ]);
        session()->flash("success", "Success");
        return redirect()->back();
    }

    public function updateService(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:jobs,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'salary' => 'required|numeric',
        ]);
        
        $job = Service::find($request->input('id'));
        $job->category_id = $request->input('category_id');
        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->salary = $request->input('salary');
        $job->save();
    }

    public function deleteService(Request $request)
    {
        Service::destroy($request->input('id'));
    }
}
