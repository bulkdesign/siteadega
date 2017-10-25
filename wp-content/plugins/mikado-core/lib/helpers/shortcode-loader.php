<?php

namespace Fleur\Modules\Shortcodes\Lib;

use Fleur\Modules\BoxHolder\BoxHolder;
use Fleur\Modules\CallToAction\CallToAction;
use Fleur\Modules\Counter\Countdown;
use Fleur\Modules\Counter\Counter;
use Fleur\Modules\ElementsHolder\ElementsHolder;
use Fleur\Modules\ElementsHolderItem\ElementsHolderItem;
use Fleur\Modules\GoogleMap\GoogleMap;
use Fleur\Modules\Separator\Separator;
use Fleur\Modules\PieCharts\PieChartBasic\PieChartBasic;
use Fleur\Modules\PieCharts\PieChartDoughnut\PieChartDoughnut;
use Fleur\Modules\PieCharts\PieChartDoughnut\PieChartPie;
use Fleur\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use Fleur\Modules\SeparatorWithIcon\SeparatorWithIcon;
use Fleur\Modules\Shortcodes\AnimationsHolder\AnimationsHolder;
use Fleur\Modules\Shortcodes\BlogSlider\BlogSlider;
use Fleur\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTable;
use Fleur\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTablesHolder;
use Fleur\Modules\Shortcodes\Icon\Icon;
use Fleur\Modules\Shortcodes\IconProgressBar;
use Fleur\Modules\Shortcodes\ImageGallery\ImageGallery;
use Fleur\Modules\Shortcodes\InfoBox\InfoBox;
use Fleur\Modules\Shortcodes\Process\ProcessHolder;
use Fleur\Modules\Shortcodes\Process\ProcessItem;
use Fleur\Modules\Shortcodes\ProcessSlider\ProcessSlider;
use Fleur\Modules\Shortcodes\ProcessSlider\ProcessSliderItem;
use Fleur\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use Fleur\Modules\Shortcodes\SectionTitle\SectionTitle;
use Fleur\Modules\Shortcodes\TeamSlider\TeamSlider;
use Fleur\Modules\Shortcodes\TeamSlider\TeamSliderItem;
use Fleur\Modules\Shortcodes\VerticalProgressBar\VerticalProgressBar;
use Fleur\Modules\Shortcodes\VideoBanner\VideoBanner;
use Fleur\Modules\SocialShare\SocialShare;
use Fleur\Modules\Team\Team;
use Fleur\Modules\OrderedList\OrderedList;
use Fleur\Modules\UnorderedList\UnorderedList;
use Fleur\Modules\Message\Message;
use Fleur\Modules\ProgressBar\ProgressBar;
use Fleur\Modules\IconListItem\IconListItem;
use Fleur\Modules\Tabs\Tabs;
use Fleur\Modules\Tab\Tab;
use Fleur\Modules\PricingTables\PricingTables;
use Fleur\Modules\PricingTable\PricingTable;
use Fleur\Modules\Accordion\Accordion;
use Fleur\Modules\AccordionTab\AccordionTab;
use Fleur\Modules\BlogList\BlogList;
use Fleur\Modules\Shortcodes\Button\Button;
use Fleur\Modules\Blockquote\Blockquote;
use Fleur\Modules\CustomFont\CustomFont;
use Fleur\Modules\Highlight\Highlight;
use Fleur\Modules\VideoButton\VideoButton;
use Fleur\Modules\Dropcaps\Dropcaps;
use Fleur\Modules\Shortcodes\IconWithText\IconWithText;
use Fleur\Modules\Shortcodes\TwitterSlider\TwitterSlider;
use Fleur\Modules\Workflow\Workflow;
use Fleur\Modules\WorkflowItem\WorkflowItem;
use Fleur\Modules\Shortcodes\ZoomingSlider\ZoomingSlider;
use Fleur\Modules\Shortcodes\ZoomingSlider\ZoomingSliderItem;
use Fleur\Modules\Shortcodes\VerticalSplitSlider\VerticalSplitSlider;
use Fleur\Modules\Shortcodes\VerticalSplitSliderContentItem\VerticalSplitSliderContentItem;
use Fleur\Modules\Shortcodes\VerticalSplitSliderLeftPanel\VerticalSplitSliderLeftPanel;
use Fleur\Modules\Shortcodes\VerticalSplitSliderRightPanel\VerticalSplitSliderRightPanel;
use Fleur\Modules\Shortcodes\StaticTextSlider\StaticTextSlider;
use Fleur\Modules\Shortcodes\TabSlider\TabSlider;
use Fleur\Modules\Shortcodes\TabSlider\TabSliderItem;
use Fleur\Modules\Shortcodes\CardsSlider\CardsSlider;
use Fleur\Modules\Shortcodes\CardsSlider\CardsSliderItem;
use Fleur\Modules\Shortcodes\ExpandingImages\ExpandingImages;
use Fleur\Modules\Shortcodes\ImageWithTextOver\ImageWithTextOver;
use Fleur\Modules\Shortcodes\ImageWithText\ImageWithText;
use Fleur\Modules\Shortcodes\ProductSlider\ProductSlider;
use Fleur\Modules\Shortcodes\WorkingHours\WorkingHours;
use Fleur\Modules\Shortcodes\IntroSection\IntroSection;


/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
	}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {
	}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {
	}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if (self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 *
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if (!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new Team());
		$this->addShortcode(new Icon());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new Message());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Separator());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new VideoBanner());
		$this->addShortcode(new AnimationsHolder());
		$this->addShortcode(new SectionTitle());
		$this->addShortcode(new SectionSubtitle());
		$this->addShortcode(new InfoBox());
		$this->addShortcode(new ProcessHolder());
		$this->addShortcode(new ProcessItem());
		$this->addShortcode(new ProcessSlider());
		$this->addShortcode(new ProcessSliderItem());
		$this->addShortcode(new ComparisonPricingTablesHolder());
		$this->addShortcode(new ComparisonPricingTable());
		$this->addShortcode(new VerticalProgressBar());
		$this->addShortcode(new IconProgressBar());
		$this->addShortcode(new BlogSlider());
		$this->addShortcode(new TwitterSlider());
		$this->addShortcode(new Workflow());
		$this->addShortcode(new WorkflowItem());
		$this->addShortcode(new TeamSlider());
		$this->addShortcode(new TeamSliderItem());
		$this->addShortcode(new ZoomingSlider());
		$this->addShortcode(new ZoomingSliderItem());
		$this->addShortcode(new VerticalSplitSlider());
		$this->addShortcode(new VerticalSplitSliderLeftPanel());
		$this->addShortcode(new VerticalSplitSliderRightPanel());
		$this->addShortcode(new VerticalSplitSliderContentItem());
		$this->addShortcode(new StaticTextSlider());
		$this->addShortcode(new BoxHolder());
		$this->addShortcode(new TabSlider());
		$this->addShortcode(new TabSliderItem());
		$this->addShortcode(new SeparatorWithIcon());
		$this->addShortcode(new CardsSlider());
		$this->addShortcode(new CardsSliderItem());
		$this->addShortcode(new ExpandingImages());
		$this->addShortcode(new ImageWithTextOver());
		$this->addShortcode(new ImageWithText());
		$this->addShortcode(new ProductSlider());
		$this->addShortcode(new WorkingHours());
		$this->addShortcode(new IntroSection());
	}

	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}

	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();