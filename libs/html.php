<?php

class HTML
{

	static public function renderHTML5Page($content, $header, $title = 'Generator elementu graficznego IMG - Remigiusz Pyrek', $subheader = 'Pozycjonowanie organiczne SEO')
	{
		$html = "";
		$html .= "<!doctype html>\n";
		$html .= "<html lang=\"pl-pl\">\n";
		$html .= "<head>\n";
		$html .= "<meta charset=\"UTF-8\">\n";
		$html .= "<title>" . $title . "</title>\n";
		$html .= "<link rel=\"stylesheet\" href=\"/css/style.css\" media=\"all\">\n";
		$html .= self::googleAnalytics();
		$html .= "</head>\n";
		$html .= "<body>\n";
		$html .= "	<header>\n";
		$html .= "		<div class=\"wrapper\">\n";
		$html .= "			<h1>" . $header . "</h1>\n";
		$html .= "			<p>" . $subheader . "</p>\n";
		$html .= "		</div>\n";
		$html .= "	</header>\n";
		$html .= "	<main>\n";
		$html .= "	<div class=\"wrapper\">\n";
		$html .= "		<!-- Begin of custom -->\n";
		$html .= "		<article>\n";
		$html .= $content;
		$html .= "		</article>\n";
		$html .= "		<!-- End of custom -->\n";
// 		$html .= "		<nav class=\"pt3em\">\n";
// 		$html .= "			<p>\n";
// 		$html .= "				<a href=\"/\"><small>&laquo; Powrót do listy</small></a>\n";
// 		$html .= "			</p>\n";
// 		$html .= "		</nav>\n";
		$html .= "	</div>\n";
		$html .= "	</main>\n";
		$html .= "	<footer>\n";
		$html .= "		<div class=\"wrapper\">\n";
		$html .= "			<p>\n";
		$html .= "				<a href=\"/\"><small>&copy; 2016 - " . date('Y') . " Remigiusz Pyrek</small></a>\n";
		$html .= "			</p>\n";
		$html .= "		</div>\n";
		$html .= "	</footer>\n";
		$html .= "<script src=\"/js/clipboard.min.js\"></script>\n";
		$html .= "<script>\n";
		$html .= "    var clipboard = new ClipboardJS('.btn');\n";
		$html .= "    clipboard.on('success', function(e) {\n";
		$html .= "        console.log(e);\n";
		$html .= "    });\n";
		$html .= "    clipboard.on('error', function(e) {\n";
		$html .= "        console.log(e);\n";
		$html .= "    });\n";
		$html .= "</script>\n";
		$html .= "</body>\n";
		$html .= "</html>";
		return $html;
	}

	static public function renderArticleSection($content, $class = false)
	{
		$html = "";
		$html .= "			<section class=\"ex";
		$html .= " " . $class;
		$html .= "\">";
		$html .= $content;
		$html .= "			</section>\n";
		return $html;
	}

	static public function renderForm($content, $submit = true, $submit_value = "OK")
	{
		$html = "";
		$html .= "<form method=\"post\" class=\"block\">";
		$html .= $content;
		if ($submit) {
			$html .= "  <div class=\"center\">\n";
			$html .= "    <button type=\"submit\" name=\"generate\" value=\"1\">" . $submit_value . "</button>\n";
			$html .= "  </div>\n";
		}
		$html .= "</form>";
		return $html;
	}

	static public function renderFieldset($content, $caption)
	{
		$html = "";
		$html .= "<fieldset>";
		$html .= "<legend>" . $caption . "</legend>";
		$html .= $content;
		$html .= "</fieldset>";
		return $html;
	}

	static public function renderSelectList($name, $options, $selected = 0, $on_change = true)
	{
		$html = "";
		$html .= "<select name=\"" . $name . "\" ";
		if ($on_change) $html .= "onchange=\"this.form.submit()\" ";
		$html .= ">";
		foreach ($options as $key => $val) {
			$html .= "  <option value=\"" . $key . "\" ";
			if ($selected == $key) $html .= "selected ";
			$html .= ">" . $val . "</option>;";
		}
		$html .= "</select>";
		return $html;
	}

	static public function renderInput($type, $name, $value, $min = false, $max = false, $step = false)
	{
		$html = "";
		$html .= "<input ";
		$html .= "type=\"" . $type . "\" ";
		$html .= "name=\"" . $name . "\" ";
		$html .= "value=\"" . $value . "\" />";
		if ($min) $html .= "min=\"" . $min . "\" ";
		if ($max) $html .= "max=\"" . $max . "\" ";
		if ($step) $html .= "step=\"" . $step . "\" ";
		return $html;
	}

	static public function googleAnalytics($gtag="G-4EEZQJ2WNJ")
	{
		$html = "";
		$html .= "<!-- Global site tag (gtag.js) - Google Analytics -->\n";
		$html .= "<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-4EEZQJ2WNJ\"></script>\n";
		$html .= "<script>\n";
		$html .= "  window.dataLayer = window.dataLayer || [];\n";
		$html .= "  function gtag(){dataLayer.push(arguments);}\n";
		$html .= "  gtag('js', new Date());\n";
		$html .= "  gtag('config', '".$gtag."');\n";
		$html .= "</script>\n";
		return $html;
	}
}
?>