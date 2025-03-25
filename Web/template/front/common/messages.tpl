<script>
{foreach $messages as $message}
	$.notify({
		message: '{$message['message']}'
	},{
		type: '{$message['type']}'
	});
{/foreach}
</script>