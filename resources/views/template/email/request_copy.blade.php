<html>
	<body style="font-style: 'Arial';">
		<div style="width: 100%; height: 5rem; background-color: #35408F; padding: 5px; text-align: center;">
			<img src="{!!$message->embed(public_path('images/UI/Branding.png'))!!}" style="width: auto; height: 100%;">
		</div>

		<div style="display: flex; flex-direction: column;">
			<div style="width: 75%; margin-left: auto; margin-right: auto;">
				<h1>Good Day!</h1>
				<p><a href="mailto:{{$email}}">{{$email}}</a> has requested a copy of your paper titled "{{$document->title}}".</p>

				<p>All other authors of the paper are also informed regarding the request.</p>
			</div>
		</div><br>

		<div style="width: 100%; height: 2.5rem; background-color: #35408F; text-align: center; padding: 5px;">
			<p style="color: #cccccc; font-size: smaller; text-align: center; width: 100%;">
				Please do not reply to this E-mail directly as this is just an automatic email and we will not receive your letter.
			</p>
		</div>
	</body>
</html>