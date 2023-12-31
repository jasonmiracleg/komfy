<?php

namespace App\Http\Controllers\Member;

use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TestimonyController extends Controller
{
    public function index()
    {
        $testimony = [];
        $testimonyRequest = [];
        if (Auth::user() != null) {
            if (Auth::user()->role_id == 1) { // Showing testimony requests
                $testimonyRequest = Testimony::where('is_accepted', '0')->get();
            } else if (Auth::user()->role_id == 2) { // Showing their own testimonies
                $testimony = Testimony::where('user_id', Auth::user()->id)->where('is_accepted', '1')->get();
            }
        }
        return view(
            'Testimonies.index',
            [
                'testimonies' => Testimony::where('is_accepted', '1')->get(),
                'mytestimony' => $testimony,
                'testimonyRequest' => $testimonyRequest
            ]
        );
    }
    public function create()
    {
        return view(
            'Testimonies.create'
        );
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|max:255'
        ]);
        Testimony::create([
            'description' => $validatedData['description'],
            'user_id' => $request['user_id'],
        ]);
        return redirect()->route('member.testimony.index');
    }

    public function edit(Testimony $testimony)
    {
        $testimonyEdit = Testimony::where('id', $testimony->id)->first();
        return view('Testimonies.edit', compact('testimonyEdit'));
    }

    public function update(Request $request, Testimony $testimony)
    {
        $testimony->update([
            'description' => $request->description,
        ]);
        return redirect()->route('member.testimony.index');
    }
    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        return redirect()->route('member.testimony.index');
    }
}
