<p>Dear <b>{{$data1['name']}}</b>,</p>
<p>We detected a sign-in to your account from a new device.</p>
<p>When:	{{date('Y-m-d H:i:s')}}</p>
<p>Device:	{{$_SERVER['HTTP_USER_AGENT']}}</p>
<p>Near:	{{$data1['country']}}</p>
