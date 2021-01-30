<?php

class ImageView
{
	
	static public function imageForm($data = array())
	{
		$html = "";
		$html .= "<form method=\"post\" class=\"block\">";
		
		$html .= "  <fieldset>\n";
		$html .= "    <legend>Parametry kodu wynikowego</legend>\n";
		$html .= "    <label for=\"schema\">Atrybuty Schema.org</label>\n";
		$html .= "    <select id=\"schema\" name=\"form_data[schema]\" onchange=\"this.form.submit()\">\n";
		$html .= self::imageOption(Image::$_schema_states, $data['schema']);
		$html .= "    </select><br />\n";
		$html .= "    <label for=\"guide\">Instrukcja użytkownika</label>\n";
		$html .= "    <select id=\"guide\" name=\"form_data[guide]\" onchange=\"this.form.submit()\">\n";
		$html .= self::imageOption(Image::$_schema_states, $data['guide']);
		$html .= "    </select><br />\n";
		$html .= "  </fieldset>\n";
		
		$html .= "  <fieldset>\n";
		$html .= "    <legend>Parametry zdjęć</legend>\n";
		$html .= "    <label for=\"hidpi\">Dodatkowe zdjęcie HiDPI 2x</label>\n";
		$html .= "    <select id=\"hidpi\" name=\"form_data[hidpi]\" onchange=\"this.form.submit()\">\n";
		$html .= self::imageOption(Image::$_hidpi_states, $data['hidpi']);
		$html .= "    </select><br />\n";
		$html .= "    <label for=\"hidpi\">Przeznaczenie zdjęcia</label>\n";
		$html .= "    <select id=\"hidpi\" name=\"form_data[image_dest]\" onchange=\"this.form.submit()\">\n";
		$html .= self::imageOption(Image::$_image_type, $data['image_dest']);
		$html .= "    </select><br />\n";
		$html .= "  </fieldset>\n";
		
		$html .= "  <fieldset>\n";
		$html .= "    <legend>Dane zdjęcia</legend>\n";
		$html .= "    <label for=\"company\">Nazwa firmy lub podmiotu</label><input class=\"full\" name=\"form_data[company_name]\" value=\"" . $data['company_name'] . "\" id=\"company\" /><br />\n";
		$html .= "    <label for=\"title\">Tytuł zdjęcia</label><input class=\"full\" name=\"form_data[article_title]\" value=\"" . $data['article_title'] . "\" id=\"title\" /><br />\n";
		$html .= "    <label for=\"path\">Ścieżka do pliku</label><input class=\"full\" name=\"form_data[image_img_src]\" value=\"" . $data['image_img_src'] . "\" id=\"path\" /><br />\n";
		$html .= "  </fieldset>\n";
		
		if($data['guide']==2) $html .= self::imageDescription($data);
		
		$html .= "  <div class=\"center\">\n";
		$html .= "    <input name=\"form_data[prefix]\" value=\"" . $data['prefix'] . "\" type=\"hidden\" />\n";
		$html .= "    <button type=\"submit\" name=\"generate\" value=\"1\">Generuj kod</button>\n";
		$html .= "  </div>\n";
		$html .= "</form>\n";
		
		return $html;
	}
	
	static public function imageResult($content)
	{
		$html = "";
		$html .= "<textarea id=\"gallery_result\" class=\"small\">\n";
		$html .= $content;
		$html .= "</textarea>\n";
		$html .= "<div class=\"center\">\n";
		$html .= "  <button class=\"btn\" data-clipboard-action=\"copy\" data-clipboard-target=\"#gallery_result\">Kopiuj do schowka</button>\n";
		// $html .= " <button onclick=\"window.location.href='/apps/gallery'\">Reset</button>\n";
		$html .= "</div>\n";
		
		return $html;
	}
	
	static public function imageDescription($data = array())
	{
		$html = "";
		$html .= "<fieldset>";
		$html .= "<legend>Instrukcja użytkownika</legend>\n";
		$html .= "<ol>\n";
		$html .= "  <li>Przygotuj odpowiednie zdjęcia w programie graficznym"; // </li>\n";
		$html .= "    <ul>\n";
		$html .= "      <li><b>" . $data['img_src_name'] ."</b> - jako zdjecie podstawowe</li>\n";
		if($data['hidpi']==2) $html .= "      <li><b>" . $data['img_srcset_name'] ."</b> - jako zdjecie HiDPI</li>\n";
		$html .= "    </ul>\n";
		$html .= "  </li>\n";
		$html .= "  <li>Prześlij pliki na serwer</li>\n";
		$html .= "  <li>Skopiuj ścieżkę z serwera</li>\n";
		$html .= "  <li>Uzupełnij swoimi danymi pola w sekcji „Dane do zdjęcia”</li>\n";
		$html .= "  <li>Wygeneruj kod</li>\n";
		$html .= "</ol>";
		$html .= "</fieldset>";
		return $html;
	}
	
	static public function imageOption($data = array(), $selected)
	{
		$html = "";
		foreach ($data as $key => $val) {
			$html .= "      <option ";
			$html .= "value=\"" . $key . "\"";
			if ($selected == $key)
				$html .= "selected";
				$html .= ">" . $val . "</option>\n";
		}
		
		return $html;
	}
	
	public static function generateHTMLimageItem($data = false)
	{
		$html = "";
		$html .= "<img src=\"" . $data['img_src'] . "\" ";
		if ($data['hidpi'] == 2)
			$html .= "srcset=\"" . $data['img_srcset'] . " 2x\" ";
			$html .= "alt=\"" . $data['img_alt'] . "\" ";
			$html .= "title=\"" . $data['img_title'] . "\" ";
			if ($data['schema'] == 2)
				$html .= "itemprop=\"image\" ";
				$html .= "/>";
				$html .= "\n";
				
				return $html;
	}
}
?>