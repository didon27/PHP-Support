<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TasksController extends Controller
{
    function index()
    {
        return view('tasks');
    }

    function tasksFilter(Request $request)
    {
        if ($request->ajax()) {
            $array_filters = [];

            if ($request->date || $request->status) {
                
                //Заполнить массив выбранными фильтрами
                if ($request->status) {
                    array_push($array_filters, ['status', '=', $request->status]);
                }

                if ($request->date) {
                    array_push($array_filters, ['date', '=', $request->date]);
                }

                $result = DB::table('post')->where($array_filters)->get();;

            } else {
                $result = DB::table('post')->orderBy('date', 'desc')->get();

            }

            echo json_encode($result);
        }
    }
}
