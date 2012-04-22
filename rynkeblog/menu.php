	<div class="wrap">
		<div id="logo">
			<h1><a href="." title="Home">Umpa Lompa blog</a></h1>
			<p>Prosjektoppgave webapplikasjoner</p>
		</div>
		<ul id="nav">
			<li><a class="current" href="." accesskey="h"><span class="akey">H</span>ome</a></li>
                        <li><a href="photo.php" accesskey="p"><span class="akey">P</span>hoto</a></li>
			<li><a href="about.php" accesskey="a"><span class="akey">A</span>bout</a></li>
			<li><a href="links.php" accesskey="m"><span class="akey">L</span>inks</a></li>
			<!--li><a href="task.htm" accesskey="r"><span class="akey">T</span>ask</a></li-->
                        <?PHP if($_SESSION['userid'] == null) { ?> 
			<li><a href="login.php" accesskey="c"><span class="akey">L</span>ogin</a></li>
                        <?PHP } ?>
			<li><a href="contact.php" accesskey="t">Con<span class="akey">t</span>act</a></li>
                        <?PHP if(isset($_SESSION['userid'])) { ?> 
                        <li><a href="blogpost.php" accesskey="s">Po<span class="akey">s</span>t artikkel</a></li >
                        <li><a href="login.php?logoff=true" accesskey="l">Log<span class="akey">o</span>ff</a></li>
                        <?PHP } ?>
		</ul>
	</div>