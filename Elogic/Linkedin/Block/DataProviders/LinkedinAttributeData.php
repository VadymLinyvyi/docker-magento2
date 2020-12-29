<?php

namespace Elogic\Linkedin\Block\DataProviders;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Provides linkedin attribute data into template.
 * Class LinkedinAttributeData
 * @package Elogic\Linkedin\Block\DataProviders
 */
class LinkedinAttributeData implements ArgumentInterface
{
    /**
     * @var Session
     */
    protected $customerSession;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * LinkedinAttributeData constructor.
     * @param Session $customerSession
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        Session $customerSession,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return mixed|string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getLinkedinAttributeData()
    {
        $result = '';
        $customerId = $this->customerSession->getId();
        if ($customerId) {
            $customer = $this->customerRepository->getById($customerId);
            $result = $customer->getCustomAttribute('linkedin_profile')->getValue();
        }
        return $result;
    }
}
