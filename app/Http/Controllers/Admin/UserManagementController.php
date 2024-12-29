<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {

        $totalUsers = User::count();
        // Fetch users with their total checkout amount
        $users = User::select('users.id', 'users.name', 'users.email', 'users.created_at')
            ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
            ->selectRaw('COALESCE(SUM(orders.total_amount), 0) as total_checkout_amount')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.created_at')
            ->paginate(10);


        // Prepare data for the registration chart
        $userRegistrations = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.users.index', [
            'users' => $users, // Paginated users
            'userRegistrations' => $userRegistrations, // Chart data
            'totalUsers' => $totalUsers, // Pass the total number of users
        ]);
    }
}

