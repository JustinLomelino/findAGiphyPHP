<!--
A simple page that uses the Giphy API (https://github.com/Giphy/GiphyAPI)
to find and display a Gif associated with the entered word.  
Author: Justin Lomelino, March 21st 2017
-->

<h2>Find A Giphy!</h2>

<form action="giphy.php" method="post">

<p>Enter your adjective below.<br>
If using a phrase, separate words with a hyphen like this:<br>
'This-is-a-test-phrase'<br></p>

<p>Search Word (or Phrase):<br>
<input type="text" name="word"></p>

<p>Rating:<br>
<input type="radio" name="rating" value="none" checked>None<br>
<input type="radio" name="rating" value="y">Y<br>
<input type="radio" name="rating" value="g">G<br>
<input type="radio" name="rating" value="pg">PG<br>
<input type="radio" name="rating" value="pg-13">PG-13<br>
<input type="radio" name="rating" value="r">R<br>
</p>

<p><input type="submit" name="submit">
<input type="reset"></p>
</form>

<?php
//print_r($_POST);
	if(count($_POST) > 0 && isset($_POST['submit'])){
		$betakey = "dc6zaTOxFJmzC";
		$requestBase = "http://api.giphy.com/v1/gifs/random";

		if($_POST['rating'] == "none"){
			$fullRequest = $requestBase . "?api_key=" . $betakey . "&tag=" . $_POST['word'];
		}
		else{
			$fullRequest = $requestBase . "?api_key=" . $betakey . "&tag=" . $_POST['word'] . "&rating=" . $_POST['rating'];
		}

//		echo $fullRequest."<br>";
//		echo $_POST['rating'];

		echo "<h2>Search Results</h2>";

		if($_POST['rating'] == "none"){
			echo "Searched: ".$_POST['word'];
		}
		else{
			echo "Searched: ".$_POST['word']."&emsp; Rating: ".$_POST['rating'];
		}
		echo "<br><br>";
//		print_r(json_decode(file_get_contents($fullRequest)));

		$giphy = json_decode(file_get_contents($fullRequest));
		$gif = $giphy->data->fixed_width_downsampled_url;
//		echo $gif."<br>";
		if(!empty($gif)){
			echo '<img src="'.$gif.'"><br><br>';
			echo "image URL: ".$gif."<br>";
		}
		else{
			echo "No Giphy was found with search term: ".$_POST['word']." :-(";
		}
	
	}
?>

