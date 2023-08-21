<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index()
    {
        if(Auth()->user()->roles[0]->name=='super-admin'){
            return
             redirect()->back()->with('error','Please login as admin.');
        }
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $branch_id = Auth()->user()->employee->branch->id;
        $employees = Employee::with('schedule', 'attendance')->where('organization_id', $org_id)->where('branch_id', $branch_id)->latest()->get();
        return view('employee.salary', compact('employees'));
    }

    public function payment($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $branch_id = Auth()->user()->branch->id;
        $payments = Salary::where('organization_id', $org_id)->where('branch_id', $branch_id)->latest()->get();
        return view('employee.payment', compact('employee', 'payments'));
    }

    public function pay(Request $request)
    {
        // return $request;

        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $request->validate([
            'salary' => 'required',
        ]);
        $carbonInstance = Carbon::now();

        $year = $carbonInstance->year;    // Get the year as an integer
        $month = $carbonInstance->month;  // Get the month as an integer
        $day = $carbonInstance->day;
        $date = ad_to_bs($year, $month, $day);
        $MyDate = $date['year'] . "-" . $date['month'] . "-" . $date['day'];

        $myPayment = Salary::where('employee_id', $request->employee_id)->whereDate('payment_from', '<=', $MyDate)->whereDate('payment_to', '>=', $MyDate)->first();

        if ($myPayment) {
            return redirect()->back()->with('error', "Already Paied. Please check payment history.");
        }

        $prevPayment = Salary::where('employee_id', $request->employee_id)->latest()->first();

        $payment = new Salary();
        $payment['organization_id'] = orgId();
        $payment['branch_id'] = Auth()->user()->employee->branch_id;
        $payment['employee_id'] = $request->employee_id;
        $payment['payment_date'] = $MyDate;
        $payment['amount_tobe_pay'] = $request->tobePay;
        $payment['paying_amount'] = $request->tobePay;
        if ($prevPayment) {
            $payment['payment_from'] = $prevPayment->payment_to;
        }
        $payment['payment_to'] = $MyDate;

        if ($request->tobePay < $request->salary) {
            $payment['advance'] = $request->salary - $request->tobePay;
            $payment['due'] = "0";
        }
        if ($request->tobePay > $request->salary) {
            $payment['due'] = $request->tobePay - $request->salary;
            $payment['advance'] = "0";
        }
        if ($request->tobePay == $request->salary) {
            $payment['due'] = "0";
            $payment['advance'] = "0";
        }

        $payment->save();

        return redirect()->back()->with('success', "Paied.");
    }
}
