<?php
/**
 * Base Controller Class File. 
 * All Controller Files Should Extend this class.
 * All methods should be lowercse and should not use non alphabetic characters.
 *
 * @copyright 	2008 richardmowatt.com
 * @license		???
 * @version 	???
 * @link 		???
 * @since		Class available since initial Release
 * @package 	MowattMedia
 * @subpackage 	Controller
 * @author 		Richard Mowatt <rmowatt@richardmowatt.com>
 */

require_once('Includes/rssreader.php');
class MowattMedia_Controllers_BaseController {

	/**
	 * provides set of global variables w/o having to declare globals (yuck!)
	 *
	 * @var MowattMedia_Application_Registry
	 */
	protected $registry;

	function __construct($registry = null) {
		$this->registry = $registry;
	}

	public function getRss() {
		$rssModel = new MowattMedia_Models_Common_Rss();
		$record = $rssModel->getSingleRecord();
		//print __LINE__;
		if(!array_key_exists('object', $record) && $record['object'] != '') {
			//print $record['object'];exit;
			$rss = unserialize($record['object'] );
		//	print_r($rss);exit;
		}else {
		$rss =  simplexml_load_file('http://feeds.feedburner.com/nettuts?format=xml');
		$rssModel->insertRecord(
			array(
				'site'=>'http://feeds.feedburner.com/nettuts?format=xml',
				'content'=>'123',
				'object'=>serialize($rss)
			)
		);
		$events = array();
		$i=0;
		if ($rss) {
			foreach ($rss->channel->item as $item) {
				if($i>2){break;}
				$description = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $item->description);
				$event = "<p>
  				<a href='" . $item->link . "' rel='shadowbox'>" . date('Y-m-d' , strtotime($item->pubDate)) ."</a><br />
          		<span><a href='" . $item->link . "' rel='shadowbox'>{$item->title}</a></span><br />".
				substr(strip_tags($description), 0, 200) .
				" <br /><a href='" . $item->link . "' rel='shadowbox'>more...</a></p> <div class='bg'></div>";
				$events[] = $event;
				$i++;
			}
			//print_r($events);exit;
			return $events;
		}
		else {
			return array();
		}
	}
}
}