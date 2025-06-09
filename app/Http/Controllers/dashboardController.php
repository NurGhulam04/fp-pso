<?php

namespace App\Http\Controllers;

use App\Http\Requests\changePasswordRequest;
use App\Models\auther;
use App\Models\book;
use App\Models\book_issue;
use App\Models\category;
use App\Models\publisher;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $mostIssuedBooks = \App\Models\book_issue::select('book_id', \DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderBy('total', 'DESC')
            ->with(['book' => function($query) {
                $query->select('id', 'name');
            }])
            ->take(5)
            ->get();

        return view('dashboard', [
            'authors' => \App\Models\auther::count(),
            'publishers' => \App\Models\publisher::count(),
            'categories' => \App\Models\category::count(),
            'books' => \App\Models\book::count(),
            'students' => \App\Models\student::count(),
            'issued_books' => \App\Models\book_issue::count(),
            'most_issued_books' => $mostIssuedBooks
        ]);
    }

    public function change_password_view()
    {
        return view('reset_password');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'c_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (password_verify($request->c_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route("dashboard")->with('success', 'Password changed successfully');
        } else {
            return redirect()->back()->withErrors(['c_password' => 'Old password is incorrect']);
        }
    }
}
