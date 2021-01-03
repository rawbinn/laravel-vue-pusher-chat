<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function getMessages(User $user, Request $request)
    {
        
        $messages = MessageResource::collection(Message::whereIn('sender_id', [$request->user('api')->id, $user->id])->whereIn('receiver_id', [$request->user('api')->id, $user->id])->orderBy('id', 'ASC')->get());
        return response()
                ->json(['data' => $messages]);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = $request->user('api');
        $receiver = User::select('id','name','email')->find($request->receiverId);

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiver->id,
            'message' => $request->message
        ]);
        
        $formatedMessage = [
            'id' => $message->id,
            'type' => 'receiver',
            'message' => $message->message,
            'timestamp' => Carbon::parse($message->created_at)->format('Y-m-d H:i'),
        ];
        broadcast(new MessageSent($user, $receiver, $formatedMessage));

        return response()->json(['message' => 'Message Sent!', 'data' => new MessageResource($message)]);
    }
}
