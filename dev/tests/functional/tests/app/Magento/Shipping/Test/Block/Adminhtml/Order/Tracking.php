<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Shipping\Test\Block\Adminhtml\Order;

use Magento\Shipping\Test\Block\Adminhtml\Order\Tracking\Item;
use Mtf\Block\Block;
use Mtf\Client\Element\Locator;

/**
 * Class Tracking
 * Tracking to ship block
 */
class Tracking extends Block
{
    /**
     * Add tracking button
     *
     * @var string
     */
    protected $addTracking = '[data-ui-id="shipment-tracking-add-button"]';

    /**
     * Item tracking block
     *
     * @var string
     */
    protected $itemTracking = './/tbody/tr[not(contains(@class,"no-display"))][%d]';

    /**
     * Get tracking block
     *
     * @param int $index
     * @return Item
     */
    protected function getItemTrackingBlock($index)
    {
        return $this->blockFactory->create(
            'Magento\Shipping\Test\Block\Adminhtml\Order\Tracking\Item',
            ['element' => $this->_rootElement->find(sprintf($this->itemTracking, $index), Locator::SELECTOR_XPATH)]
        );
    }

    /**
     * Fill tracking
     *
     * @param array $data
     * @return void
     */
    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if (!$this->getItemTrackingBlock(++$key)->isVisible()) {
                $this->_rootElement->find($this->addTracking)->click();
            }
            $this->getItemTrackingBlock($key)->fillRow($value);
        }
    }
}
