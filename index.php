<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PyEmailValidator;

class CleanEmailsAndPhonesController extends Controller
{
    public function index()
    {
        $data = DB::table('table_name')->get();

        foreach ($data as $row) {
            foreach (['Email 1', 'Email 2', 'Email 3'] as $email_column) {
                if (!PyEmailValidator::validate($row[$email_column])) {
                    $row[$email_column] = '';
                }
            }

            if (substr($row['Main Phone'], 0, 3) === '020' || substr($row['Main Phone'], 0, 3) === '20') {
                $row['Main Phone'] = '';
            }
        }

        DB::table('table_name')->update($data);

        return view('clean_emails_and_phones');
    }
}


