<?php

namespace wpai_acf_add_on\fields\acf;

use wpai_acf_add_on\ACFService;
use wpai_acf_add_on\fields\Field;

/**
 * Class FieldEmail
 * @package wpai_acf_add_on\fields\acf
 */
class FieldEmail extends Field {

    /**
     *  Field type key
     */
    public $type = 'email';

    /**
     *
     * Parse field data
     *
     * @param $xpath
     * @param $parsingData
     * @param array $args
     */
    public function parse($xpath, $parsingData, $args = array()) {
        parent::parse($xpath, $parsingData, $args);
        $values = $this->getByXPath($xpath);
        $this->setOption('values', $values);
    }

    /**
     * @param $importData
     * @param array $args
     * @return void
     */
    public function import($importData, $args = array()) {
        $isUpdated = parent::import($importData, $args);
        if ($isUpdated){
            ACFService::update_post_meta($this, $this->getPostID(), $this->getFieldName(), $this->getFieldValue());
        }
    }
}