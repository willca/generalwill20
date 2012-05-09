<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>いるか</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
<script  type="text/javascript">
    function disableSubmit(form) {
      var elements = form.elements;
      for (var i = 0; i < elements.length; i++) {
        if (elements[i].type == 'submit') {
          elements[i].disabled = true;
        }
      }
    }
</script>
  </head>
  <body>
    <div>
      <h2><a href="/">いるか</a></h2>

      <?php
	   if($access_token) {
			include_once("search.inc");		
		}
      	print "@{$screen_name}　API 残り回数:{$limit}{$reset_string}</p>";
      ?>

      <p><a href='./clearsessions.php'>ログアウト</a></p>

      <hr />
    </div>
    <p>
    </p>

  </body>
</html>
