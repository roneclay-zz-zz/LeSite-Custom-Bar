<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace LeSite\CustomBar\Block\Html;

use Magento\Customer\Block\Account\Customer;
use Magento\Customer\Model\Group;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Welcome extends Template
{
    /**
     * @var Customer
     */
    protected Customer $customer;

    /**
     * @var Session
     */
    protected Session $_customerSession;

    /**
     * @var Group
     */
    protected Group $_customerGroupCollection;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Customer $customer
     * @param Session $customerSession
     * @param Group $customerGroupCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Customer $customer,
        Session $customerSession,
        Group $customerGroupCollection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customer = $customer;
        $this->_customerSession = $customerSession;
        $this->_customerGroupCollection = $customerGroupCollection;
    }

    /**
     * @return string
     */
    public function getCustomerGroup(): string
    {
        $currentGroupId = $this->_customerSession->getCustomer()->getGroupId();
        $collection = $this->_customerGroupCollection->load($currentGroupId);

        return $collection->getCustomerGroupCode();
    }

    /**
     * @return bool
     */
    public function customerLoggedIn(): bool
    {
        return $this->customer->customerLoggedIn();
    }
}
