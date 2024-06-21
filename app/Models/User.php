<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Builder\FallbackBuilder;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function storeUser($request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'phone' => 'required|numeric',
        ]);

        $data['password'] = bcrypt($data['password']);


        $user = User::create($data);


        UserActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'User registered name as ' . $user->name,
            'details' => 'User registered from ' . $request->ip(),
        ]);
        //auth()->login($user);

    }

    public function logout($request)
    {

        UserActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'User logged out',
            'details' => 'User logged out from ' . $request->ip(),
        ]);

        auth()->logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function login($request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $user = auth()->user();

            UserActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'User logged in named as ' . $user->name,
                'details' => 'User logged in from ' . $request->ip(),
            ]);

            $request->session()->regenerate();

            //

            return true;
        }
        return false;
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
