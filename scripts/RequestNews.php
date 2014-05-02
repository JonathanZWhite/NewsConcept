<?php

/** 
 * Requests news from Google News
 */

// ini_set('display_startup_errors',1);
// ini_set('display_errors',1);
// error_reporting(-1);

class RequestNews {

	private $type_of_request		= '';
	private $request 				= '';
	private $base_search_url 		= '';
	private $base_category_url 		= '';
	private $search_url				= '';
	private $news_information 		= '';
	private $news;

	public function __construct($jsonData) {
		$this->jsonData = $jsonData;
		$this->userInput = json_decode($this->jsonData, true);

		// isset($type_of_request) ? $this->type_of_request = $this->userInput->{ 'type_of_request' } : null;
		// isset($request) ? $this->request = $this->userInput{' request '} : null;
		$this->type_of_request = $this->userInput->{'type_of_request'};
		$this->request = $this->userInput{'request'};
		
		$this->base_search_url = 'https://news.google.com/news/feeds?num=4&output=rss&q='; 
		$this->base_category_url = 'https://news.google.com/news?pz=1&cf=all&ned=us&output=rss&num=20&topic=';

		$this->request_url();

	}

	function request_url() {

		if ($this->type_of_request == 'search') {
			$this->search_url = $this->base_search_url . $this->request;
		} else {
			switch($this->request) {
				case 'Business':
					$this->search_url = $this->base_category_url . 'b';
					break;
				case 'Technology':
					$this->search_url = $this->base_category_url . 'tc';
					break;
				case 'World':
					$this->search_url = $this->base_category_url . 'w';
					break;
				default: 
					$this->search_url = $this->base_category_url . '';
					break;
			}
		}

		$news = simplexml_load_file($this->search_url);

		$this->parse_url($news);

	}	

	function parse_url($news) {
		foreach ($news->channel->item as $item) {

			$title = $item->title;
			$url = substr($item->link, strrpos($item->link, 'url=') + 4);

			$pattern = '/src="([^"]*)"/';
    		preg_match($pattern, $item->description, $matches);
    		$image = str_replace('"', '', str_replace('src="//', '', $matches[0]));

    		$components = explode('<font size="-1">', $item->description);
   			$description = strip_tags($components[2]);

    		$this->news_information = $this->news_information . '
    			<li> 
    				<div class="feed-left">
    					<a href="' . $url . '"><img src="http://' . $image . '"></a>
    				</div>
    				<div class="feed-right">
    					<h2 class="feed-title"><a href="' . $url . '"> ' . $title . '</a></h2></a>
    					<p class="feed-story"> ' . $description . ' </p> 
    				</div>
    			</li>
    		';

		}

		echo $this->news_information;
	}

}

$request_news = new RequestNews($_POST['data']);
// $request_news = new RequestNews('category', 'Technology');

?>


