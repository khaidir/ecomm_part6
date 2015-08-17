<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64943107-1', 'auto');
  ga('send', 'pageview');

</script>	

	<?php 
	ini_set('display_errors', true);
	///$conn=mysqli_connect('localhost','webtutplus','webtutplus','webtut_ecomm')or die("cannot connect");
	$conn=mysqli_connect('localhost','root','25011994','ecomm')or die("cannot connect");
	if (!$conn) {
		echo "cannot connect";
	}

session_start();
	?>