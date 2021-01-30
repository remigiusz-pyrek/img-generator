<?php
/**
 * @desc    Generator kodu dla znaczanika <img>
 * @author  Remigiusz Pyrek
 */
ini_set('display_errors', 0);
define('DS', DIRECTORY_SEPARATOR);
define('LIBS', realpath(dirname(__FILE__)) . DS . ".." . DS . ".." . DS . "libs" . DS);
require_once (LIBS . 'fnc.php');
require_once (LIBS . 'html.php');
require_once (LIBS . 'cookie.php');
require_once ('view.php');

class Image
{
	private $cookie_time = 60 * 60 * 24 * 365;
	public static $_file_types = [
		1 => "gif",
		"jpg",
		"png"
	];
	public static $_hidpi_states = [
		1 => "Nie",
		"Tak"
	];
	public static $_schema_states = [
		1 => "Nie",
		"Tak"
	];
	public static $_image_type = [
		1 => "Artykuł",
		"Sekcja",
		"Intro",
		"Produkt",
		"Film"
	];
	private $_data = [
		'company_name' => 'Remigiusz Pyrek',
		'article_title' => 'Praktycznie o informatyce',
		"schema" => 2,
		"guide" => 1,
		"hidpi" => 1,
		
		'image_img_src' => '/galeria/zdjecie.jpg',
		'image_no' => 1,
		'image_dest' => 1
	];
	private $_open_graph = [
		'site_name' => 'Remigiusz Pyrek',
		'url' => '/apps/image/',
		'title' => 'Prosty i darmowy generator kodu IMG',
		'desc' => 'Generator kodu IMG – narzędzie, które stworzyłem, aby zautomatyzować niektóre elementy w mojej pracy administratora. Pozycjonowanie dzięki opisywaniu grafiki pozwala osiągnąć lepsze wyniki. Skorzystaj za darmo!',
		'image' => '/apps/image/img/remigiusz-pyrek-og-img-generator.jpg',
		'image_alt' => 'Zdjęcie do posta „Generator kodu IMG'
	];
	private $_page = [
		'title' => 'Generator znacznika &lt;img&gt; - Remigiusz Pyrek',
		'header' => 'Generator elementu graficznego &lt;img&gt;',
		'sub_header' => 'Pozycjonowanie organiczne SEO'
	];

	public function __construct()
	{
		$this->_getEnvData();
		$this->_getImageData();
		$this->_generateImageData();
		$this->main();
	}

	public function main()
	{
		$content = "";
		$content .= HTML::renderArticleSection(ImageView::imageForm($this->_data));
		$meta = HTML::renderOpenGraph($this->_open_graph['site_name'], $this->_open_graph['url'], $this->_open_graph['title'], $this->_open_graph['desc'], $this->_open_graph['image'], $this->_open_graph['image_alt']);
		if (isset($_REQUEST['generate'])) $content .= HTML::renderArticleSection(ImageView::imageResult(ImageView::generateHTMLimageItem($this->_data)));
		print HTML::renderHTML5Page($content, $this->_page['header'], $this->_page['title'], $this->_page['sub_header'], $meta);
	}

	private function _getEnvData()
	{
		foreach ($this->_data as $key => $value) {
			if (! isset($_REQUEST['form_data'][$key])) {
				$$key = Cookie::instance()->get('ce_' . $key);
				if ($$key) $this->_data[$key] = $$key;
			}
			if (isset($_REQUEST['form_data'][$key])) {
				Cookie::instance()->set('ce_' . $key, $_REQUEST['form_data'][$key], $this->cookie_time);
				$this->_data[$key] = $_REQUEST['form_data'][$key];
			}
		}
	}

	private function _generateImageData()
	{
		$this->_data['img_src_name'] = $this->_generateImgSrcName();
		$this->_data['img_src'] = $this->_generateImgSrc();
		$this->_data['img_srcset_name'] = $this->_generateImgSrcsetName();
		$this->_data['img_srcset'] = $this->_generateImgSrcset();
		$this->_data['img_title'] = $this->_generateImgTitle($this->_data['image_no']);
		$this->_data['img_alt'] = $this->_generateImgAlt($this->_data['image_no']);
	}

	private function _getImageData()
	{
		$file = function ($path) {
			$data = pathinfo($path);
			$file['name'] = $data['basename'];
			$file['file_name'] = $data['filename'];
			$file['dir'] = $data['dirname'];
			in_array($data['extension'], self::$_file_types) ? $file['ext'] = $data['extension'] : $file['ext'] = self::$_file_types[1];
			return $file;
		};
		$this->_data = $this->_data + $file($this->_data['image_img_src']);
	}

	private function _generateImgSrcName()
	{
		$html = "";
		$html .= $this->_data['file_name'] . "." . $this->_data['ext'];
		return $html;
	}

	private function _generateImgSrc()
	{
		$html = "";
		$html .= $this->_data['dir'] . DS . $this->_data['file_name'] . "." . $this->_data['ext'];
		return $html;
	}

	private function _generateImgSrcset()
	{
		$html = "";
		$html .= $this->_data['dir'] . DS . $this->_data['file_name'] . "-2x." . $this->_data['ext'];
		return $html;
	}

	private function _generateImgSrcsetName()
	{
		$html = "";
		$html .= $this->_data['file_name'] . "-2x." . $this->_data['ext'];
		return $html;
	}

	private function _generateImgTitle()
	{
		$html = $this->_data['article_title'] . " - " . $this->_data['company_name'];
		// $html = $this->_data['article_title'] . " - " . $this->_data['company_name'] . " - %s. zdjęcie";
		return sprintf($html, $this->_data['image_no']);
	}

	private function _generateImgAlt()
	{
		$html = "Zdjęcie do " . $this->_imageDestinationName($this->_data['image_dest']) . " „" . $this->_data['article_title'] . "” - " . $this->_data['company_name'] . "";
		return $html;
	}

	private function _imageDestinationName($type = 1)
	{
		switch ($type) {
			case 2:
				$name = "sekcji";
				break;
			case 3:
				$name = "intro";
				break;
			case 4:
				$name = "produktu";
				break;
			case 5:
				$name = "filmu";
				break;
			default:
				$name = "artykułu";
				break;
		}
		return $name;
	}
}

$gallery = new Image();
?>
