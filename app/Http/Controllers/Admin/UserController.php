<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderByDesc('created_at')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', [
            'user' => new User(),
            'roles' => $this->assignableRoles(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $roleNames = $data['roles'] ?? [];
        unset($data['roles']);

        $user = User::create($data);
        $user->syncRoles($roleNames);
        $user->syncAdminFlagFromRoles();

        return redirect()->route('admin.users.index')->with('status', 'User created.');
    }

    public function edit(int $id)
    {
        $user = User::with('roles')->findOrFail($id);

        return view('admin.users.form', [
            'user' => $user,
            'roles' => $this->assignableRoles(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $data = $this->validateData($request, $user->id);
        $roleNames = $data['roles'] ?? [];
        unset($data['roles']);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);
        $user->syncRoles($roleNames);
        $user->syncAdminFlagFromRoles();

        return redirect()->route('admin.users.index')->with('status', 'User updated.');
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'You cannot delete your own account.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'User deleted.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $assignable = $this->assignableRoles()->pluck('name')->all();

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($ignoreId)],
            'password' => [$ignoreId ? 'nullable' : 'required', 'string', 'min:8'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['string', Rule::in($assignable)],
        ]);
    }

    private function assignableRoles()
    {
        return Role::query()
            ->where('guard_name', 'web')
            ->with('permissions')
            ->orderBy('name')
            ->get();
    }
}
