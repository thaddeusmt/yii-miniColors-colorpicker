<?php
/**
 * SActiveColorPicker class file.
 *
 * @author Evan Johnson <thaddeusmt@gmail.com>
 * @link http://www.yiiframework.com/extension/miniColors
 * @copyright Copyright &copy; 2011 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2
 *
 * miniColors JQuery Plugin:
 * http://abeautifulsite.net/blog/2011/02/jquery-minicolors-a-color-selector-for-input-controls/
 * http://plugins.jquery.com/project/jQueryMiniColors
 *
 * A typical CActiveForm usage (with a model) of JColorPicker is as follows:
 * <pre>
 * $this->widget('ext.SMiniColors.SActiveColorPicker', array(
 *     'model' => $model,
 *     'attribute' => 'myModelAttribute',
 *     'options' => array(), // jQuery plugin options
 *     'htmlOptions' => array(), // html attributes
 * ));
 * </pre>
 *
 */

class SActiveColorPicker extends CWidget
{
  /**
   * @var CActiveRecord model
   */
  public $model;
  /**
   * @var name of the CActiveRecord model attribute
   */
  public $attribute;
  /**
   * @var array miniColors jQuery plugin options
   */
  public $options = array();
  /**
   * @var array input element attributes
   */
  public $htmlOptions = array();

  /**
	 * Initializes the widget.
	 * This method will publish jQuery and miniColors plugin assets if necessary.
   * @return void
	 */
  public function init()
  {
    $activeId = CHtml::activeId($this->model, $this->attribute);

    $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'source';
    $baseUrl = Yii::app()->getAssetManager()->publish($dir);

    $cs = Yii::app()->getClientScript();
    $cs->registerCoreScript('jquery');
    $cs->registerScriptFile($baseUrl.'/jquery.miniColors.min.js');
    $cs->registerCssFile($baseUrl.'/jquery.miniColors.css');

    $options = CJavaScript::encode($this->options);

    $cs->registerScript('miniColors-'.$activeId, '$("#'.$activeId.'").miniColors('.$options.');');
  }

  /**
	 * Renders the widget.
   * @return void
	 */
  public function run()
  {
    echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
  }
}
