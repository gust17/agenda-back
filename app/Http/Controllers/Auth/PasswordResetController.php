<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CustomPasswordResetEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{


    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                $resetUrl = env('FRONTEND_URL') . '/reset-password/' . $token;

                // Enviar o e-mail personalizado
                Mail::to($user->email)->send(new CustomPasswordResetEmail($resetUrl));
            }
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$passwordReset) {
            return response()->json(['message' => 'Token inválido ou expirado'], 422);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        // Atualiza a senha do usuário
        $user->password = Hash::make($request->password);
        $user->save();

        // Remove o token após a redefinição de senha
        DB::table('password_resets')->where('token', $request->token)->delete();

        return response()->json(['message' => 'Senha redefinida com sucesso']);
    }
}


