<html>

<head>

	%ENCODING%
	<title>
	%DOMAIN% - bounties list
	</title>

	%CSS%
</head>
	
<body>

	%HEADER%
	
	<h1>%DOMAIN% - bounties list</h1>
	<table>
		<tr>
			<td>
				Description
			</td>
			
			<td>
				Collected
			</td>
		</tr>
		
		%_BLOCKSTART_BOUNTYENTRY%
		<tr>
			<td>
				%_BLOCK_DESC%
			</td>
			
			<td>
				%_BLOCK_COLLECTED%
			</td>
		</tr>
		%_BLOCKEND_BOUNTYENTRY%
	</table>
	
	<p>
		<a href="%LINK_PREFIX%/newbounty/">Add a new bounty!</a>
	</p>
</html>
</body>