<?php

namespace App\Base;

use Exception;

/**
 * Базовый класс контроллеров
 * 
 * Этот абстрактный класс предоставляет базовую функциональность для контроллеров,
 * включая обработку запросов и ответов, загрузку представлений и управление ошибками.
 */
abstract class ControllerBase
{
	protected $view;

	public function __construct()
	{
		$this->view = new class {
			/**
			 * Метод для загрузки представления и передачи данных
			 * 
			 * @param string $viewName Имя представления для загрузки
			 * @param string $layoutName Имя подключаемого шаблона страницы
			 * @param array $data Данные, которые будут доступны в представлении
			 * 
			 * @throws Exception Если представление не найдено
			 */
			public function render($viewName, $layoutName, $data): void
			{
				extract($data);

				$content = "app/views/$viewName.php";
				$layout = "app/views/$layoutName.php";

				if (file_exists($content)) {
					if (file_exists($layout)) {
						include($layout);
					} else {
						include($content);
					}
				} else {
					throw new Exception('Представление не найдено: $viewName');
				}
			}
		};

		session_start();
	}

	/**
	 * Загружает представление
	 * 
	 * @param string $viewName Имя представления для загрузки
	 * @param string $layoutName Имя подключаемого шаблона страницы
	 * @param array $data Данные, которые будут доступны в представлении
	 */
	protected function render(string $viewName, string $layoutName='layout', array $data = []): void
	{
		$this->view->render($viewName, $layoutName, $data);
	}
}