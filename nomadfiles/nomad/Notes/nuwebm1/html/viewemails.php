<?php
        echo "<html>\n";
        echo "<head>\n";
        echo "<title>Emails</title>\n";
	echo "<style type=\"text/css\">\n";
	echo "body {\n";
        echo "padding-top: 40px;\n";
	echo "}\n";
	echo "</style>\n";
        
        echo "<link rel=\"stylesheet\" href=\"http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css\">\n";
	echo "</head>\n";
	echo "<body>";
	echo "<br>";
	echo "<div class=\"container\">";
        echo "<table class=\"bordered-table\">\n";
        echo "<tr>\n";
        echo "<th> Email </th>\n";
        echo "</tr>\n";
	if($_POST['name'] == 'nuwebm1' AND $_POST['passwd'] == 'nuwebm11'){
	
		//connect to the database
		mysql_connect("localhost","root","nuwebm11") or die(myql_error());
		mysql_select_db("nomad") or die(mysql_error());
		$result = mysql_query("SELECT * FROM emails") or die(mysql_error());
	
		while($row = mysql_fetch_array($result)) {
                        echo "<tr><td>\n";
			echo $row['email'];
                        echo "</td></tr>\n";
		}
	}
	echo "</table>\n";
	echo "</div>";
	echo "</body>";
        echo "</html>\n";
	
?>