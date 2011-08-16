<html>

<head>

	%ENCODING%
	<title>
	%DOMAIN% - viewing '%BOUNTYDESC%'
	</title>

	%CSS%
</head>
	
<body>

	%HEADER%
	<br />%HOMELINK%
	
	<h1>%DOMAIN% - view a bounty</h1>
	<h2>%BOUNTYDESC%</h2>
	<table>
		<tr>
			<td>
				Donations collected:
			</td>
			<td>
				%DONATED% <a href="%LINK_PREFIX%/donate/%BOUNTYID%">[DONATE]</a>
			</td>
		</tr>
		
		<tr>
			<td>
				Submissions to vote:
			</td>
			
			<td>
				%SUBMISSIONS% <a href="%LINK_PREFIX%/newcommit/%BOUNTYID%">[SUBMIT]</a>
						<a href="%LINK_PREFIX%/commits/%BOUNTYID%">[VIEW]</a>
			</td>
		</tr>
		
		<tr>
			<td>
				Description:
			</td>
			
			<td>
				%DESCRIPTION%
			</td>
		</tr>
	</table>
</body>
</html>