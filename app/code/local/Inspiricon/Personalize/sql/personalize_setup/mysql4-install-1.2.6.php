<?php


$installer = $this;

$installer->startSetup();

// define custom attributes
$template_data= array (
    'attribute_set' =>  'Default',
    'group' => 'Images',
    'label'    => 'Default Template Label',
    'visible'     => true,
    'type'     => 'varchar', // multiselect uses comma-sep storage
    'input'    => 'media_image',
    'system'   => true,
    'required' => true,
    'user_defined' => 1, //defaults to false; if true, define a group
);


$template_data['label'] = 'Markju Background';
$installer->addAttribute('catalog_product','markju_image', $template_data);

$template_data['group'] = 'General';
$template_data['label'] = 'Low left X';
$template_data['input'] = 'text';
$installer->addAttribute('catalog_product','markju_left_x', $template_data);
$template_data['label'] = 'Low left Y';
$installer->addAttribute('catalog_product','markju_left_y', $template_data);

$template_data['label'] = 'Upper right X';
$installer->addAttribute('catalog_product','markju_right_x', $template_data);
$template_data['label'] = 'Upper right Y';
$installer->addAttribute('catalog_product','markju_right_y', $template_data);


// set UI
Mage::getDesign()->setArea('frontend') //Area (frontend|adminhtml)
->setPackageName('markju') //Name of Package
->setTheme('default'); // Name of theme


// create custom table
$installer->run("
 
-- DROP TABLE IF EXISTS {$this->getTable('personalize')};
CREATE TABLE {$this->getTable('personalize')} (
  `product_id` int(20) unsigned UNIQUE NOT NULL,
  `leftx` int(20) NOT NULL default '0',
  `lefty` int(20) NOT NULL default '0',
  `rightx` int(20) NOT NULL default '0',
  `righty` int(20) NOT NULL default '0',
  `imgurl` varchar(200),
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");


 
$installer->endSetup();
