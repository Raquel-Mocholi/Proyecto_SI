 <body style="height:100%">
	<div id="container">
		<div id="content">
			<div id="map"></div>
		</div>
		<div id="menu">
			<div class="button"><i class="fa fa-home"></i></div>
			<div class="button"><i class="fa fa-qrcode"></i></div>
			<div class="button"><i class="fa fa-cog"></i></div>
			<div class="button"><i class="fa fa-power-off"></i></div>
		</div>
	</div>
	<div id="cardPlace">
		<div class="card-place-title"></div>
		<div class="card-place-image"></div>
		<div class="card-place-speech">
			<audio controls id="audio">
				  <source id="audioSource" src="" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<div class="card-place-description"></div>
		<div class="card-place-close" onClick="closeCard()"><i class="fa fa-sign-out"></i></div>
	</div>
</body>