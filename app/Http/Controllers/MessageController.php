<?php

namespace App\Http\Controllers;
use App\Mail\NewMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageConfirmation;
use Illuminate\Http\Request;
use App\Message;
class MessageController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function store(Request $request)
    {

        $validate_message = Message::getValidation($request->all());

        // si les inputs ne sont pas valide
        if ($validate_message->fails())
        {
            return response()->json(['error' => 'Bad Request'], Response::HTTP_BAD_REQUEST);
        }

        // Si la validation se passe normaleement
        $new_message = Message::createOne($request->all());


        Mail::to(env('MAIL_RECEIVER'))->send(new NewMessage($new_message));

        Mail::to($new_message->email)->send(new MessageConfirmation($new_message));
        return response()->json($new_message);
    }
}