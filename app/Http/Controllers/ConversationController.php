<?php

namespace App\Http\Controllers;

class ConversationController extends Controller
{
    public function hs_conversation()
    {
        return view('superadmin.pages.conversation.index');

    }
}
