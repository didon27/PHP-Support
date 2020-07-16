<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tasks;

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
                    array_push($array_filters, ['created_at', '=', $request->date]);
                }
                $result = Tasks::where($array_filters)->get();;
            } else {
                $result = Tasks::orderBy('created_at', 'desc')->get();
            }

            echo json_encode($result);
        }
    }
}
