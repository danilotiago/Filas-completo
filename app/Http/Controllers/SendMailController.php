<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public function enviaEmail()
    {
        $this->dispatch(new SendMailJob());
    }
}
