<?php

class ConfigViewCacheComponent extends Component {

	public $configName = 'ViewCache';
	public $useCallback = null;

	public function startup(Controller $controller) {

		$config = Configure::read($this->configName . '.' . $controller->name);
		if ($config) {

			if (empty($controller->cacheAction)) {
				$controller->cacheAction = array();
			}

			$controller->cacheAction = array_merge($config, $controller->cacheAction);

			if (!is_null($this->useCallback) && is_array($controller->cacheAction)) {
				foreach ($controller->cacheAction as &$cacheSettings) {
					if (!is_array($cacheSettings)) {
						$cacheSettings = array(
							'duration' => $cacheSettings,
						);
					}

					if (isset($cacheSettings['callbacks'])) {
						continue;
					}

					$cacheSettings['callbacks'] = $this->useCallback;
				}
			}

		}

		return true;

	}

}
