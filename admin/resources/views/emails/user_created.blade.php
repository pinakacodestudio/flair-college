Hi {!! $user->full_name !!}!<br/><br/>
{!! config('app.name') !!} invited you to join. Use following link to complete process.<br/><br/>
{!! route('user_invitation_link',['token'=>$user->invitation_token,'email'=>$user->email]) !!}<br/><br/>
Regards<br/>
{!! config('app.name') !!}