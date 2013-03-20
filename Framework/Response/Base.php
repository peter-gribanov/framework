<?php
/**
 * Microsoft package
 * 
 * @package Microsoft
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */

namespace Microsoft\Response;

/**
 * Какой-либо ответ от вызова метода приложения пригодный несущий часть данных
 *
 * @package Microsoft
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
abstract class Base {

	/**
	 * Контент
	 *
	 * @var string
	 */
	private $content = null;


	/**
	 * Установить новый контент
	 *
	 * @param string $data Новый контент
	 */
	public function __construct($data = '') {
		$this->setContent($data);
	}

	/**
	 * Установить новый контент
	 *
	 * @param string $new_content Новый контент
	 *
	 * @return \Microsoft\Response\Base
	 */
	public function setContent($new_content) {
		$this->content = $new_content;
		return $this;
	}

	/**
	 * Возвращает контент
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Отправляет ответ клиенту
	 */
	abstract public function transmit();

}