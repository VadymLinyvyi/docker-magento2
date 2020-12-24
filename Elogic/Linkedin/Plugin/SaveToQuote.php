<?php

namespace Elogic\Linkedin\Plugin;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\ShippingInformationManagement;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\QuoteRepository;

/**
 * Class SaveToQuote
 * @package Elogic\Linkedin\Plugin
 */
class SaveToQuote
{
    /**
     * @var QuoteRepository
     */
    protected $quoteRepository;

    /**
     * SaveToQuote constructor.
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param ShippingInformationManagement $subject
     * @param $cartId
     * @param ShippingInformationInterface $addressInformation
     * @throws NoSuchEntityException
     */
    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        if ($extAttributes = $addressInformation->getExtensionAttributes()) {
            $quote = $this->quoteRepository->getActive($cartId);
            $quote->setLinkedinProfile($extAttributes->getLinkedinProfile());
        }
    }
}
