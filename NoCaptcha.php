<?php
namespace sprytechies\nocaptcha;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;


class Nocaptcha extends InputWidget
	{
	/** @var array for g-recaptcha tag attributes */
		public $widgetOptions = [];
		/** @var string url of g-recaptcha js*/
		private $script = '//www.google.com/recaptcha/api.js';
		/**
		* @inheritdoc
		* @throws InvalidConfigException
		*/
		public function init()
		{
			parent::init();
			if (!isset($this->widgetOptions['data-sitekey'])) {
				throw new InvalidConfigException('Required data-sitekey property');
			}
		}
		/**
		* @inheritdoc
		*/
		public function run()
		{
			$this->registerJs();
			$view = $this->view;
			if($this->hasModel()){
                 echo Html::activeHiddenInput($this->model, $this->attribute);
			}else{
				 	echo Html::hiddenInput($this->name);
				 }
			$options = ['class' => 'g-recaptcha'];
			foreach (['data-sitekey', 'data-theme', 'data-type', 'data-callback'] as $dataAttribute) {
				if ($value = ArrayHelper::getValue($this->widgetOptions, $dataAttribute)) {
					$options[$dataAttribute] = $value;
				}
			}
			echo Html::tag('div', '', $options);
		}
		private function registerJs()
		{
			$view = $this->view;
			$params = [];
			foreach (['onload', 'render', 'hl'] as $attribute) {
				if ($value = ArrayHelper::getValue($this->widgetOptions, $attribute)) {
					$params[$attribute] = $value;
				}
			}
			$scriptUrl = $this->script;
			if ($params) {
				$scriptUrl .= '?' . http_build_query($params);
			}
				$view->registerJsFile($scriptUrl);
		}
	}

