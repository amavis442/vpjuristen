<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceTrait;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    use InvoiceTrait;
}
