<html>
	<body style="font-family: 'Arial'; margin: 0; max-width: 100%; width: 100%">
		<div style="height: 5rem; background-color: #35408F; padding: 5px; text-align: center;">
			<img src="{!!$message->embed(public_path('images/UI/Branding - Transparent - Inverted.png'))!!}" style="width: auto; height: 100%;">
		</div>

		<div style="display: flex; flex-direction: column;">
			<div style="width: 75%; margin-left: auto; margin-right: auto;">
				<h1>Hello!</h1>
				<p>Your account has been created just recently and you're now ready to access it!</p>

				<p>To access your account, go to the <a href="{{ route('login') }}">login</a> page and enter the credentials below:</p>
				
				<code style="font-size: large;">
					<span style="font-family: Arial;">Username:</span> {{ $req->username }}<br>
					<span style="font-family: Arial;">Password:</span> {{ $req->password }}
				</code>
			</div>
		</div><br>

		<div style="height: 2.5rem; background-color: #35408F; text-align: center; padding: 5px;">
			<p style="color: #cccccc; font-size: smaller; text-align: center; width: 100%;">
				Please do not reply to this e-mail directly as this is just an automatic email and we will not receive your letter.
			</p>
		</div>
	</body>
</html>