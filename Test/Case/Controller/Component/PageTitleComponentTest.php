<?php
/* PageTitle Test cases generated on: 2011-12-10 12:46:52 : 1323488812*/

App::import('TestSuite', 'Ninja.NinjaComponentTestCase');

class PageTitleComponentTest extends NinjaComponentTestCase {

	public $fixtures = false;

	public function testGetTitle() {
		$this->assertNull($this->PageTitle->getTitle());

		$this->Controller->pageTitle = 'pageTitle';
		$this->assertEquals('pageTitle', $this->PageTitle->getTitle());

		unset($this->Controller->pageTitle);
		$this->Controller->pageTitles = array('undefined' => 'undefined');
		$this->assertNull($this->PageTitle->getTitle());

		$this->Controller->pageTitles = array('test_action' => 'pageTitles');
		$this->assertEquals('pageTitles', $this->PageTitle->getTitle());

		unset($this->Controller->pageTitles);
		$this->Controller->defaultTitle = 'default';
		$this->assertEquals('default', $this->PageTitle->getTitle());

		$this->Controller->pageTitle = 'pageTitle';
		$this->Controller->titlePrefix = 'prefix_';
		$this->assertEquals('prefix_pageTitle', $this->PageTitle->getTitle());

		$this->Controller->titleSuffix = '_suffix';
		$this->assertEquals('prefix_pageTitle_suffix', $this->PageTitle->getTitle());

	}

	public function testBeforeRender() {
		$this->PageTitle->beforeRender($this->Controller);
		$this->assertFalse(isset($this->Controller->viewVars['title_for_layout']));

		$this->Controller->pageTitle = 'pageTitle';
		$this->PageTitle->beforeRender($this->Controller);
		$this->assertTrue(isset($this->Controller->viewVars['title_for_layout']));

		unset($this->Controller->viewVars['title_for_layout']);
		$this->PageTitle->autoSet = false;
		$this->PageTitle->beforeRender($this->Controller);
		$this->assertFalse(isset($this->Controller->viewVars['title_for_layout']));

		$this->PageTitle->autoSet = 'formTitle';
		$this->PageTitle->beforeRender($this->Controller);
		$result = isset($this->Controller->viewVars['formTitle']);
		$this->assertTrue($result);
		if ($result) {
			$this->assertEquals('pageTitle', $this->Controller->viewVars['formTitle']);
		}

	}

}
