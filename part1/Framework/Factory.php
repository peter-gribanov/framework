<?php
/**
 * Example PHP Framework
 * 
 * @package Framework
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace Framework;

use Framework\View\NativePHP;
use Framework\View\Iface;

/**
 * Представление
 * 
 * @package Framework
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Factory {

	/**
	 * Представление
	 * 
	 * @var Framework\View\Iface
	 */
	private $view;

	/**
	 * Фабрика моделей
	 * 
	 * @var Framework\Model\Factory
	 */
	private $model;

	/**
	 * Корневая папка проекта
	 * 
	 * @var string
	 */
	private $root;


	/**
	 * Конструктор
	 * 
	 * @param string $root Корневая папка проекта
	 */
	public function __construct($root) {
		$this->root = $root;
		// регистрируем автолоадер
		spl_autoload_register(function ($class) use ($root) {
			$class_file = $root.'/'.str_replace('\\', '/', $class).'.php';
			if (is_readable($class_file)) {
				require_once $class_file;
			}
		});
	}

	/**
	 * Представление
	 * 
	 * @return Framework\View\NativePHP
	 */
	public function View() {
		if (!($this->view instanceof Iface)) {
			$this->view = new NativePHP($this->getDir().DIRECTORY_SEPARATOR.'templates');
		}
		return $this->view;
	}

	/**
	 * Корневая папка проекта
	 * 
	 * @return string
	 */
	public function getDir() {
		return $this->root;
	}

	/**
	 * Возращает модель или фабрику моделей
	 * 
	 * @param string|null $name Название модели
	 * 
	 * @return Framework\Model\Factory
	 */
	public function getModel($name = null) {
		if (!$this->model) {
			$this->model = new Model\Factory();
		}
		return $name ? $this->model->get($name) : $this->model;
	}

}