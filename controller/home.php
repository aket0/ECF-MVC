<div>
	{% for film in films %}
		<div>
			<form method="post">
				<div class="container">
					
					<label for="title">
						<b>{{film.getTitre}}
						{{film.getRealisateur}}
						<img src="{{film.getAffiche}}" alt="">
						{{film.getAnnee}}
						</b>
					</label>
					
					<input value="{{film.getId}}" name="id" type="hidden">

				</div>
			</form>
		</div>
	{% endfor %}
</div>
