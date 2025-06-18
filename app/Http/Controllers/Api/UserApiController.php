<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserApiController extends Controller
{
    public function index()
{
    $users = User::select('id', 'first_name', 'last_name', 'email', 'phone', 'date_of_birth', 'status', 'occupation', 'created_at')
        ->paginate(100); 

    return response()->json([
        'success' => true,
        'message' => 'User list fetched successfully.',
        'data' => $users->items(),
        'meta' => [
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
        ],
    ]);
}

}
