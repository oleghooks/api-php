<?php
/**
 * Class template
 * Назначение: Шаблонизатор
 */


class Template{
    public $template = "";
    public $template_var = array();
    private $templates_folder = "./templates/";

    /**
     * [__construct dobule function load]
     * @param variable $template_uri [description]
     * @param variable $section      [description]
     */
    public function __construct($template_uri = "main", $section = "BASIC"){
        $this->load($template_uri, $section);
    }

    /**
     * Загружает шаблон
     * @param  variable $template_uri Имя файла с шаблонами, все шаблоны должны ходиться в папке переменной $templates_folder
     * @param  variable $section      Секция в шаблоне, если секция не указана, то присвается BASIC
     * @return [type]                 Загружает шаблон в переменную template класса
     */

    public function load($template_uri, $section = "BASIC"){
        $temp_template = file_get_contents($this->templates_folder.$template_uri.".html");
        $start = "";
        preg_match_all('|\[TEMPLATE_'.$section.'\] (.*) \[/TEMPLATE_'.$section.'\]|ixs', $temp_template, $start);
        $this->template = $start[1][0];
        unset($start);
        unset($temp_template);
    }

    /**
     * Меняет значение {$name} на $value в переменной template
     * @param variable $name  Что менять
     * @param variable $value На что менять
     */
    public function set($name, $value){
        $this->template = str_replace("{".$name."}", $value, $this->template);
    }

    /**
     * Управление условиями в шаблоне
     * @param value $name  Имя условия
     * @param int $value на что менять
     */
    public function setVar($name, $value){
        $this->template_var[$name] = $value;
    }

    /**
     * Возвращает переменную template и приводит в действия условия указанные функцией setVar
     * @return text Возвращает готовый шаблон
     */
    public function view(){
        foreach($this->template_var as $key => $value)
          $this->template = preg_replace('|\[IF\s'.$key.'\s==\s'.$value.'\] (.*?) \[/IF\]|ixs', '$1', $this->template);
        $this->template = preg_replace('|\[IF  (.*?) \[/IF\]|ixs', '', $this->template);
        return $this->template;
        $this->destroy();
    }

    /**
     * Удаляет из памяти перменную класса template
     * @return boolean Исход операции
     */
    public function destroy(){
        unset($this->template);
    }
}
?>
