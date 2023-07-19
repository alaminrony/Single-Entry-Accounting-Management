<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\RoleToAccess;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Transaction;
use App\Models\VisaApplication;
use App\Models\PassportApplication;
use App\Models\MedicalApplication;
use App\Models\TicketApplication;
use App\Models\Package;
use DB;

class Helper {

    public static function dateFormat($date) {
        return date('d M Y \a\t h:i A', strtotime($date));
    }

    public static function dateFormat2($date) {
        if (!empty($date)) {
            return date('d M Y', strtotime($date));
        }
        return '';
    }

    public static function timeFormat($time) {
        return date('h:i:s A', strtotime($time));
    }

    public static function status($data) {

        if ($data == '1') {
            echo "Active";
        } else {
            echo "Inactive";
        }
    }

    public static function pendingCheque($data) {

        if ($data == '1') {
            echo "Approved";
        } else {
            echo "Pending";
        }
    }

    public static function accessToMethod() {
        if (Auth::check()) {
            echo "User logged , user_id : " . $userID;
        } else {
            echo "Not logged"; //It is returning this
        }
        exit;

        if ($roleToAccess->isNotEmpty()) {
            $accessArr = [];
            $i = 0;
            foreach ($roleToAccess as $access) {
                $accessArr[$access->module_id][$i] = $access->module_operation_id;
                $i++;
            }
        }
    }

    public static function balanceCalculation($id) {
        $in_balances = Transaction::where('user_id', $id)->where('transaction_type', 'in')->sum('amount');
        $out_balances = Transaction::where('user_id', $id)->where('transaction_type', 'out')->sum('amount');

        $payableBalance = $in_balances - $out_balances;
        $data['in_balances'] = $in_balances;
        $data['out_balances'] = $out_balances;
        $data['payableBalance'] = $payableBalance;

        return $data;
    }

    public static function log($data) {
        if (!empty($data)) {
            if (DB::table('logs')->insert($data)) {
                return true;
            }
        }
        return false;
    }

    public static function userLog($data) {
        if (!empty($data)) {
            if (UserLog::insert($data)) {
                return true;
            }
        }
        return false;
    }

    public static function getIssueCode($issueType, $issueId) {

        if ($issueType == 'visa') {
            $cusCode = VisaApplication::where('id', $issueId)->select('customer_code')->first();

            return $cusCode->customer_code ?? '';
        } elseif ($issueType == 'passport') {
            $cusCode = PassportApplication::where('id', $issueId)->select('customer_code')->first();

            return $cusCode->customer_code ?? '';
        } elseif ($issueType == 'medical') {
            $cusCode = MedicalApplication::where('id', $issueId)->select('customer_code')->first();

            return $cusCode->customer_code ?? '';
        } elseif ($issueType == 'ticket') {
            $cusCode = TicketApplication::where('id', $issueId)->select('customer_code')->first();
            return $cusCode->customer_code ?? '';
        } elseif ($issueType == 'package') {
            $cusCode = Package::where('id', $issueId)->select('name')->first();
            return $cusCode->name ?? '';
        }
    }

}
