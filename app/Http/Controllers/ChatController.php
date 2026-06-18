<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * LISTAR CONVERSACIONES DEL USUARIO
     */
    public function index()
    {
        $userId = Auth::id();

        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->with(['userOne', 'userTwo'])
            ->latest()
            ->get();

        return view('chat.index', compact('conversations'));
    }

    /**
     * ABRIR CHAT
     */
    public function show(int $id)
{
    $conversation = Conversation::with([
        'messages.sender',
        'userOne',
        'userTwo'
    ])->findOrFail($id);

    // 🔒 seguridad: solo participantes pueden ver el chat
    $authId = Auth::id();

    if ($conversation->user_one_id !== $authId &&
        $conversation->user_two_id !== $authId) {

        abort(403, 'No autorizado');
    }

    // identificar "el otro usuario"
    $otherUser = $conversation->user_one_id === $authId
        ? $conversation->userTwo
        : $conversation->userOne;

    return view('chat.show', compact('conversation', 'otherUser'));
}

    /**
     * CREAR O ABRIR CONVERSACIÓN (SIN DUPLICADOS)
     */
    public function start(int $userId)
    {
        $authId = Auth::id();

        if ($authId == $userId) {
            return back()->with('error', 'No puedes chatear contigo mismo');
        }

        // buscar conversación existente (A-B o B-A)
        $conversation = Conversation::where(function ($q) use ($authId, $userId) {
            $q->where('user_one_id', $authId)
              ->where('user_two_id', $userId);
        })
        ->orWhere(function ($q) use ($authId, $userId) {
            $q->where('user_one_id', $userId)
              ->where('user_two_id', $authId);
        })
        ->first();

        // si no existe, crear
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $authId,
                'user_two_id' => $userId
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    /**
     * ENVIAR MENSAJE
     */
    public function send(Request $request, int $conversationId)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $conversation = Conversation::findOrFail($conversationId);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $request->message
        ]);

        return back();
    }
    
}