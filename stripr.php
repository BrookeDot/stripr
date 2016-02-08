<?php 
/*
Name: Stripr
URI: https://github.com/BandonRandon/stripr
Date: 2010, December 28nd
Description: This project will take content copied from the web or other content with unwanted and strip all non-text formating. 
Author: Brooke Dukes
Author URI: http://brooke.codes/stripr
Version: 1.0
(c) 2010 Brooke Dukes All Rights Reserved
  
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<style type="text/css">
	/* Set the font for the print style sheet */
	@media print{
		body{ background-color:#FFFFFF; }
		p{font-family: Times New Roman, serif; color: black; font-size: 12pt; } 
		.reset_link{ display:none; }
		}
	</style>
	<title> Stripr </title>
</head>
<body>
<?php 
	//get the action
	$a = $_GET[ 'a' ];
	
	$self = $_SERVER['PHP_SELF'];
	
	//see if both the action isn't set to print or the input is blank show the form
	if( ( $a !="print") || ( $_POST[ 'textinput' ] == "" ) ) { ?>
		<h3> Insert text to be converted below and press submit</h3>
		<form method="post" action="<?php echo $self ?>?a=print">
		<textarea cols="70" rows="20" name="textinput"></textarea><br/>
		<input type="checkbox" name="keep_paragraphs" value="true" checked="checked"> Keep Paragraphs<br>
		<input type="submit" value="Submit" />
		</form>
	<?php } else {
		//get the text
		$text = $_POST[ 'textinput' ];
		
		
		if ( get_magic_quotes_gpc() ){
		$text = stripslashes( $text );
		// strip off the slashes if they are magically added.
		}
		$text = htmlentities( $text );
		//if we should keep paragrah formatting
		$p = $_POST[ 'keep_paragraphs' ];
		if( $p == "true" ){
			$text = nl2br( $text );
		}
		?>
		<!-- display reset and print links at top of content  -->
		<div class="reset_link">
		<SCRIPT LANGUAGE="JavaScript"> 
			if (window.print) {
				document.write('<form><input type=button name=print value="Print" onClick="window.print()" <form method="post" action="<?php echo $self?>"> <input type="submit" value="Reset" /></form>');
			}
		</script>

		</div>
		<!-- display content  -->
		<p> <?php echo($text); ?></p>
		<!-- display reset and print links at botom of content  -->
		<div class="reset_link">
		<SCRIPT LANGUAGE="JavaScript"> 
			if (window.print) {
				document.write('<form><input type=button name=print value="Print" onClick="window.print()" <form method="post" action="<?php echo $self?>"> <input type="submit" value="Reset" /></form>');
			}
		</script>
		</div>
	<?php } ?>
</body>
</html>
