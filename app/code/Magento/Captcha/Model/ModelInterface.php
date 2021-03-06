<?php
/**
 * Captcha interface
 *
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Captcha\Model;

interface ModelInterface
{
    /**
     * Generates captcha
     *
     * @abstract
     * @return void
     */
    public function generate();

    /**
     * Checks whether word entered by user corresponds to the one generated by generate()
     *
     * @param string $word
     * @return bool
     * @abstract
     */
    public function isCorrect($word);

    /**
     * Get Block Name
     * @return string
     */
    public function getBlockName();
}
