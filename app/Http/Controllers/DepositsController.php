<?php

namespace App\Http\Controllers;

use App\Deposits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositsController extends Controller
{
    public function add($id, Request $request)
    {
        $request->validate([
            'deposit_amount' => 'required|numeric'
        ]);

        DB::beginTransaction();

        try {
            $deposit = new Deposits();

            $deposit->deposit = $request->deposit_amount;
            $deposit->account_id = $id;

            $deposit->save();

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect('/')->withErrors(['Error occured!']);
        }

        return redirect('/')->with('message', 'Deposit added');
    }
}
