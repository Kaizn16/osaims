<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Constants\StudentConstants;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Models\Departments;
use App\Models\Courses;
use App\Models\Role;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserId = Auth::id();

        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.role_id')
            ->where('users.user_id', '!=', $currentUserId)
            ->where('users.is_deleted', 0)
            ->select('users.*', 'roles.role_type')
            ->get();

        $totalStaff = $users->where('role_type', 'staff')->count();
        $totalStudents = $users->where('role_type', 'student')->count();

        return view('users.index', compact('users', 'totalStaff', 'totalStudents'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Departments = Departments::all();
        $Courses = Courses::all();
        $YearLevels = StudentConstants::YEAR_LEVELS;
        $Sex = StudentConstants::SEX;
        $Roles = Role::where('role_type', '!=', 'admin')->get();

        return view('users.user-form', compact('Departments', 'Courses', 'YearLevels', 'Sex', 'Roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'full_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'age' => 'required|integer|min:0',
            'sex' => 'required|string',
            'role' => 'required|string',
        ];

        if ($request->role == 3) { // 3 - Student
            $rules['department'] = 'required|exists:departments,department_id';
            $rules['course'] = 'required|exists:courses,course_id';
            $rules['year_level'] = 'required|string';
        } else {
            $rules['department'] = 'nullable';
            $rules['course'] = 'nullable';
            $rules['year_level'] = 'nullable';
        }

        $validatedData = $request->validate($rules);

        $username = $request->role == 2 ? $validatedData['student_id'] : null;

        $userData = [
            'fullname' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'username' => $username,
            'password' => Hash::make($validatedData['password']),
            'age' => $validatedData['age'],
            'sex' => $validatedData['sex'],
            'role_id' => $validatedData['role'],
            'availability_status_id' => null,
        ];

        if ($request->role == 3) { // Student
            $userData['student_id'] = $validatedData['student_id'];
            $userData['department_id'] = $validatedData['department'];
            $userData['course_id'] = $validatedData['course'];
            $userData['year_level'] = $validatedData['year_level'];
        }
        User::create($userData);

        return redirect()->route('Users')->with('success', 'User created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user_id)
    {
        $user = User::find($user_id);

        $Departments = Departments::all();
        $Courses = Courses::all();
        $YearLevels = StudentConstants::YEAR_LEVELS;
        $Sex = StudentConstants::SEX;
        $Roles = Role::where('role_type', '!=', 'admin')->get();

        return view('users.user-form', compact('user', 'Departments', 'Courses', 'YearLevels', 'Sex', 'Roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $rules = [
            'full_name' => 'required|string|max:255',
            'student_id' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('users')->ignore($user->user_id, 'user_id')
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->ignore($user->user_id, 'user_id')
            ],
            'password' => 'nullable|string|min:8',
            'age' => 'required|integer|min:0',
            'sex' => 'required|string',
            'role' => 'required|string',
        ];

        // Check if the role is for 'Student' and apply extra validation rules
        if ($request->role == 3) { // 3 - Student
            $rules['department'] = 'required|exists:departments,department_id';
            $rules['course'] = 'required|exists:courses,course_id';
            $rules['year_level'] = 'required|string';
        } else {
            $rules['department'] = 'nullable';
            $rules['course'] = 'nullable';
            $rules['year_level'] = 'nullable';
        }

        $validatedData = $request->validate($rules);

        $password = $request->password ? Hash::make($validatedData['password']) : $user->password;

        $username = $request->role == 2 ? $validatedData['student_id'] : null;

        $userData = [
            'fullname' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'username' => $username,
            'password' => $password,
            'age' => $validatedData['age'],
            'sex' => $validatedData['sex'],
            'role_id' => $validatedData['role'],
            'availability_status_id' => null,
        ];

        // Handle role-specific fields for students
        if ($request->role == 3) { // Student
            $userData['student_id'] = $validatedData['student_id'];
            $userData['department_id'] = $validatedData['department'];
            $userData['course_id'] = $validatedData['course'];
            $userData['year_level'] = $validatedData['year_level'];
        }

        // Update the user
        $user->update($userData);

        // Redirect back with success message
        return redirect()->route('Users')->with('success', 'User updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user_id)
    {
        $user = User::find($user_id);

        $user->is_deleted = 1;
        $user->save();

        return redirect()->route('Users')->with('success', 'User deleted successfully!');
    }

    public function getCoursesByDepartment($department_id)
    {
        $courses = Courses::where('department_id', $department_id)->get();
        return response()->json($courses);
    }
    public function getUsers(Request $request)
    {
        $role = $request->input('role');
        $search = $request->input('search');
        $rowsPerPage = $request->input('rowsPerPage', 10);
        $page = $request->input('page', 1);
    
        $query = User::query()
                    ->join('roles', 'users.role_id', '=', 'roles.role_id')
                    ->select('users.*', 'roles.role_type');
    
        // Exclude admin roles
        $query->where('roles.role_type', '!=', 'admin')->where('is_deleted', 0);
    
        if ($role) {
            $query->where('roles.role_type', $role);
        }
    
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('users.fullname', 'like', '%' . $search . '%')
                ->orWhere('users.username', 'like', '%' . $search . '%')
                ->orWhere('users.student_id', 'like', '%' . $search . '%')
                ->orWhere('users.email', 'like', '%' . $search . '%');
            });
        }
    
        $users = $rowsPerPage === 'All'
            ? $query->get()
            : $query->paginate($rowsPerPage, ['*'], 'page', $page);
    
        return response()->json([
            'data' => $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->items() : $users,
            'from' => $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->firstItem() : 1,
            'to' => $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->lastItem() : count($users),
            'total' => $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->total() : count($users),
            'current_page' => $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->currentPage() : 1,
            'per_page' => $rowsPerPage === 'All' ? count($users) : $users->perPage(),
            'prev_page_url' => $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->previousPageUrl() : null,
            'next_page_url' => $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->nextPageUrl() : null
        ]);
    }    
}