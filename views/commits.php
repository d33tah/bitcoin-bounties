<html>

<head>

	%ENCODING%
	<title>
	%DOMAIN% - commits list for '%BOUNTYDESC%'
	</title>

	%CSS%
</head>
	
<body>

	%HEADER%
	
	<h1>%DOMAIN% - commits list</h1>
	<h2>%BOUNTYDESC%</h2>
	<table>
		<tr>
			<td>
				Author
			</td>
			
			<td>
				%% votes
			</td>
		</tr>
		
		%_BLOCKSTART_SUBMITENTRY%
		<tr>
			<td>
				<a href="%LINK_PREFIX%/viewcommit/%_BLOCK_COMMIT_ID%">%_BLOCK_AUTHOR%</a>
			</td>
			
			<td>
				%_BLOCK_PERCENT% 
					<a href="%LINK_PREFIX%/votecommit/%_BLOCK_COMMIT_ID%">[VOTE UP]</a>
			</td>
		</tr>
		%_BLOCKEND_SUBMITENTRY%
	</table>
	
	<p>
		<a href="%LINK_PREFIX%/newcommit/%BOUNTYID%">Add a new commit!</a>
	</p>
</html>
</body>