<?php require('header.php'); ?>  
  <body>
    <section id="side-panel">
    	<header>
    		<img id="logo" src="img/logo.png">
    	</header>
    	<nav>	
    		<ul id="nav">
    			<li value="Business"><img src="img/circle.png"><a>#Business</a><img src="img/arrow.png"></li>
    			<li value="Technology"><img src="img/circle.png"><a>#Technology</a><img src="img/arrow.png"></li>
    			<li value="World"><img src="img/circle.png"><a>#World</a><img src="img/arrow.png"></li>
    		</ul>
    	</nav>
    </section>
    <section id="main-panel">
    	<div id="main-panel-container">
    		<div id="search-container">
    			<form id="search-bar">
    				<input placeholder="Search for a keyword...">
    				<button>Search</button>
    			</form>
    		</div>
    		<ul id="news-feed">
    		</ul>
    	</div>
    </section>
  </body>
<?php require('footer.php'); ?>