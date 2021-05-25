<?php

namespace App\Http\Controllers\Api\Auth;

use App\Board;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Middleware\JWT;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTAuthController extends BaseApiController
{
    //

    public function __construct()
    {
        //부모 클래스에서 설정한 생성자 메소드를 호출함
        parent::__construct();

        //미들웨어 설정
        //login과 register 메소드 할 땐 JWT 미들웨어 생략. 토큰이 없어도 됨
        $this->middleware('jwt', ['except'=>['login', 'register']]);
    }

    public function login(Request $request)
    {
        //사용자가 입력한 정보
        $credentials = request(['email', 'password']);

        //입력된 정보로 토큰값을 가져옴
        $token = auth()->attempt($credentials);
        //dd($token);

        if(!$token){
            //로그인 한 사용자가 인증 실패 시, 401에러 보내주기
            return response()->json(['error' => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

    //토큰 반환 형식을 만들기
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //토큰 만료시간(60분)
            'expires_in' => auth()->factory()->getTTL() * 60,
            'current_user' => auth()->user()
        ]);
    }

    //회원가입
    public function register(RegisterRequest $request)
    {
        // 새로운 사용자 만들기
        $newUser = Admin::create($request->all());

        // 방금 생성한 사용자로 로그인 실행
        return $this->login($request);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    //현재 접속한 사용자 정보 가져옴
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    //현재 토큰 갱신함
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function adminList() {
        $list = Admin::orderBy('id', 'desc')->paginate(5);
        return view('/list')->with('list', $list);
    }

}
