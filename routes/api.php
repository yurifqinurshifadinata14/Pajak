<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PajakController;

Route::get('pajak',[PajakController::class,'index']);
