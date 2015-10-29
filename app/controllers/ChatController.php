<?php

class ChatController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */
    protected function setupLayout()
    {
        $this->sendRandomMessage();
        parent::setupLayout();
    }

	public function showUserChats( $id=0 )
	{
        if( $id == 0 )
        {
            $_user = Subscription::select("user")->orderByRaw("RAND()")->first();
            $id = $_user->user;
            $signal = "Messages for random user #$id retrieved in:";
        }
        else
            $signal = "Messages for user #$id retrieved in:";
        $_rooms = Subscription::select("room")->where('user', '=', trim($id)*1 )->get();
        $_chats = Message::whereIn( 'room', $_rooms->toArray() )->orderBy('when', 'ASC')->orderBy('room', 'DESC')->get();
        $chats = array();
        foreach( $_chats as $chat )
        {
            if( !isset($chats[ $chat->room ]) ) $chats[ $chat->room ] = array();
            array_push( $chats[ $chat->room ], $chat );
        }
        return View::make('UserChats')->withChat( $chats )->withSignal( $signal );
	}

    public function showUsers( $page = 0 )
    {
        $_users = User::paginate(100);
        return View::make('Users')->withUsers( $_users );
    }

    public function showChanel( $room )
    {
        $chats = Message::where( 'room', $room )->orderBy('when', 'ASC')->get();
        return View::make('Chat')->withChat( $chats );
    }

    public function showSend()
    {
        return View::make('Send');
    }

    public function showPostMessage()
    {
        $data = Input::all();
        $from = trim( $data['from'] )*1;
        $users = explode( ',', preg_replace('/[^0-9,]+/', '', $data['to'] ) );
        array_push( $users, $from );
        $users = array_unique( $users );

        $r = $this->_send( $from, $users, $data['message'] );

        if( $r->new )
            return View::make('Send')->withSignal("New conversation ( <a href='".URL::to('konwersacja', $r->room)."'>#".$r->room."</a> ) created in");
        else
            return View::make('Send')->withSignal("Adding to existing conversation ( <a href='".URL::to('konwersacja', $r->room)."'>#".$r->room."</a> ) in");

    }

    public function sendRandomMessage()
    {
        $lipsum = array( 'Lorem','ipsum','dolor','sit','amet','consectetur','adipiscing','elit','Integer','nec','odio','Praesent','libero','Sed','cursus','ante','dapibus','diam','Sed','nisi','Nulla','quis','sem','at','nibh','elementum','imperdiet','Duis','sagittis','ipsum','Praesent','mauris','Fusce','nec','tellus','sed','augue','semper','porta','Mauris','massa','Vestibulum','lacinia','arcu','eget','nulla','Class','aptent','taciti','sociosqu','ad','litora','torquent','per','conubia','nostra','per','inceptos','himenaeos','Curabitur','sodales','ligula','in','libero','Sed','dignissim','lacinia','nunc','Curabitur','tortor','Pellentesque','nibh','Aenean','quam','In','scelerisque','sem','at','dolor','Maecenas','mattis','Sed','convallis','tristique','sem','Proin','ut','ligula','vel','nunc','egestas','porttitor','Morbi','lectus','risus','iaculis','vel','suscipit','quis','luctu' );
        shuffle( $lipsum );
        $message = implode( ' ', array_slice( $lipsum,0,rand(1,100) ) );
        $from = rand(1,199000);

        $users = array();
        for( $n=0; $n<rand(1,10); $n++ ){
            do $u = rand(1,199000);
            while( $u == $from );
            array_push( $users, $u );
        }
        array_push( $users, $from );

        $r = $this->_send( $from, $users, $message );
        if( $r->new )
            return View::make('Layout')->withSignal("New conversation ( <a href='".URL::to('konwersacja', $r->room)."'>#".$r->room."</a> ) created in");
        else
            return View::make('Layout')->withSignal("Adding to existing conversation ( <a href='".URL::to('konwersacja', $r->room)."'>#".$r->room."</a> ) in");

    }

    private function _send( $from, $users, $message )
    {
        $when = ( new DateTime() )->format('Y-m-d H:i:s');

        $_room = Subscription::select("room")
            ->whereIn('user', $users )
            ->groupBy('room')
            ->havingRaw('count(*) = ' . count($users) )
            ->first();

        if( $_room == null )
        {
            DB::beginTransaction();
            $m = DB::select('select max(room) as "m" from messages;');
            if( isset($m) && count($m) )
            {
                $r = new Message;
                $r->room = $m[0]->m + 1;
                $r->when = $when;
                $r->from = $from;
                $r->message = $message;
                $r->save();
                $room = $r->room;
            }
            DB::commit();
            foreach( $users as $user )
                DB::statement("INSERT INTO subscriptions ( `user`,room ) values ( $user, $room ) ON DUPLICATE KEY UPDATE room=room;");

            $ret = new stdClass();
            $ret->new = true;
            $ret->room = $r->room;

            return $ret;
        }
        else
        {
            $r = new Message;
            $r->room = $_room->room;
            $r->when = $when;
            $r->from = $from;
            $r->message = $message;
            $r->save();

            $ret = new stdClass();
            $ret->new = false;
            $ret->room = $r->room;

            return $ret;
        }
    }
}
