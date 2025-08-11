<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function planPage(){
         $plans = Plan::all();
        return view('admin-side.plans' , compact('plans'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly',
        ]);

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->billing_period = $request->billing_period;
        $plan->save();

        return redirect()->back()->with('success', 'Plan created successfully.');
    }

    public function edit($id){
        $plan = Plan::findOrFail($id);
        return response()->json($plan);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->billing_period = $request->billing_period;
        $plan->save();

        return redirect()->back()->with('success', 'Plan updated successfully.');
    }
    
   public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return response()->json(['message' => 'Plan deleted successfully.']);
    }
}
    