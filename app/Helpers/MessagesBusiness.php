<?php

namespace App\Helpers;
use App\DataTransferObjects\MessagesDto;
use App\Helpers\Permissions;
use App\Http\Helpers\Response;
use App\Http\Requests\Message\SendMessageRequest;
use App\Http\Resources\MessagesResource;
use App\Services\MessageServices;
use Illuminate\Http\Request;

class MessagesBusiness{
    private MessageServices $services;
    public function __construct(MessageServices $messageServices)
    {
        $this->services=$messageServices;
    }

    public function sendMessages(SendMessageRequest $sendMessageRequest){
        if(Permissions::can($sendMessageRequest,'enviar_mensaje')){
            $dto=MessagesDto::fromApiRequest($sendMessageRequest);
            $message = $this->services->sendMessages($dto, $sendMessageRequest->user()->id);
            if($message){
                return Response::created($message->toArray());
            }
            return Response::NotFound("Error al enviar el mensaje");
        }
        return Response::Forbiden();
    }
    public function getMyMessages(Request $req){
        if(Permissions::can($req,'ver_mensajes_recibidos')){
            $messages = $this->services->getMyMessages($req->user()->id);
            if($messages){
                return Response::success($messages);
            }
            return Response::NotFound("Error al enviar el mensaje");
        }
        return Response::Forbiden();

    }
    public function getMySentMessages(Request $req){
        if(Permissions::can($req,'ver_mensajes_enviados')){
            $messages = $this->services->getMySentMessages($req->user()->id);
            if($messages){
                return Response::success($messages);
            }
            return Response::NotFound("Error al enviar el mensaje");
        }
        return Response::Forbiden();

    }
    public function getMessage(Request $req){
        $message = $this->services->getMessage($req->id, $req->user()->id);
        if($message){
            return Response::success($message->toArray());
        }
        return Response::NotFound("Mensaje no encontrado");
    }

}
