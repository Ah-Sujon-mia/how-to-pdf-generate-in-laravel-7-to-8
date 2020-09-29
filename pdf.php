<?php

namespace App\Http\Controllers\Practice;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Exports\PostExport;
use App\Imports\PostImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class Practice extends Controller
{
    // post index
    public function index(){
        $Post = Post::paginate(10);
        return view('practice',compact('Post'));
    }

    // post all excel format download
    public function PostExport(){
        return Excel::download(new PostExport, 'post.xlsx');
    }

    // post all csv format download
    public function PostCsv() {
        return Excel::download(new PostExport, 'post.csv');
    }

    // post import index
    public function PostView(){
        return view('post');
    }

    // post import
    public function PostImport(Request $request){
        $path = $request->file('files');

        Excel::import(new PostImport, $path);

        return redirect('/')->with('message', 'Post Data Import Successfull.');
    }

    // employee index
    public function employee(){
        $employee = Employee::all();
        return view('employee', compact('employee'));
    }

    // post pdf index
    public function pdf(){
        $PostPdf = Post::all();
        return view('post-pdf', compact('PostPdf'));
    }

    // post pdf
    public function PostPdf(){
        $PostPdf = Post::all();
        $pdf = PDF::loadView('post-pdf', compact('PostPdf'));
        return $pdf->download('post-list.pdf');
    }

    // employee pdf
    public function EmployeePdf(){
        $employee = Employee::all();
        $pdf = PDF::loadView('employee', compact('employee'));
        return $pdf->download('employee-list.pdf');
    }
}
