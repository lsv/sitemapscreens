<?php

class WebTest
	extends PHPUnit_Extensions_Selenium2TestCase
{

	private $screenshotpath;
	private $screenurl;
	private $sitemapurl = '#SITEMAPURL#';
	private $starturl;

	public function setUp()
	{
		$this->setBrowser('firefox');

		$url = parse_url($this->sitemapurl);
		$this->starturl = $url['scheme'] . '://' . $url['host'];

        $this->setBrowserUrl($this->starturl);

		$url = parse_url($this->getBrowserUrl());
		$this->screenurl = $url['host'];
		$this->screenshotpath = __DIR__ . '/screenshots/' . $this->screenurl;

		if (! is_dir($this->screenshotpath)) {
			mkdir($this->screenshotpath, 0777, true);
		}

	}

	private function screenshot($url)
	{
		$filedata = $this->currentScreenshot();

		$url = preg_replace('/^\//', '', $url);
		$url = preg_replace('/\/$/', '', $url);
		$url = preg_replace('/\//', '_', $url);

		if ($url == '') {
			$url = 'index';
		}

        file_put_contents($this->screenshotpath . '/' . $url . '.png', $filedata);
	}

	public function testSitemap()
	{
		$xml = simplexml_load_string(file_get_contents($this->sitemapurl));
		foreach($xml->url AS $url) {
			$loc = (string)$url->loc;

			if (strpos($loc, $this->starturl) !== false) {
				$url = str_replace($this->starturl, '', $loc);
				$this->url($url);
				$this->screenshot($url);
			}
		}
	}

}