<?php
Yii :: import('zii.widgets.CMenu');
class MyMenu extends CMenu {
// must set this to allow  parameter changes in CMenu widget call
    public $activateItemsOuter = true;

    public function run() {
        $this->renderMenu($this->items);
    }
 	protected function renderMenuRecursive($items) {
 		  $n = count($items);
 		  foreach ($items as $item) {
 		  	 $count++;
 		  	 $options = isset ($item['itemOptions']) ? $item['itemOptions'] : array();
 		  }
 	}
}