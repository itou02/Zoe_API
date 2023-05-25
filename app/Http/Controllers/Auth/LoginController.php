use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (!Auth::guard('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $token = Auth::guard('api')->attempt($credentials);

    return $this->respondWithToken($token);
}