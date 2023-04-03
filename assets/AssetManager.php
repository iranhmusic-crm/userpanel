<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;

class AssetManager extends \yii\web\AssetManager
{
	public $linkAssets = true;
	// public $forceCopy = true;

	public function init()
	{
		$hashCallback = function($path) : string {
			$path = (is_file($path) ? dirname($path) : $path) . filemtime($path);
			return sprintf('%x', crc32($path . Yii::getVersion() . '|' . $this->linkAssets));
		};

		$this->hashCallback = $hashCallback;

		$bower_bootstrap = realpath(Yii::getAlias('@bower/bootstrap'));

		$this->assetMap = [
			'bootstrap.css' => $hashCallback($bower_bootstrap) . '/dist/css/bootstrap.rtl.css',
		];

		parent::init();

 	}

}
