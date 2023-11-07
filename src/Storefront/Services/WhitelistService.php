<?php

namespace JblMaintenanceLogin\Storefront\Services;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

/**
 * Class WhitelistService
 * @package JblMaintenanceLogin\Storefront\Services
 * @author Jeffry Block <hello@jeffblock.de>
 */
class WhitelistService {


    /**
     * @param EntityRepository $salesChannelRepository
     */
    public function __construct(private readonly EntityRepository $salesChannelRepository) {
    }

    /**
     * Adds an IP address to the whitelist of the given sales-channel
     * @param string $ip
     * @param string $salesChannelId
     * @param SalesChannelContext $context
     * @author Jeffry Block <hello@jeffblock.de>
     */
    public function whitelist(string $ip, string $salesChannelId, SalesChannelContext $context) : void{

        /** @var array $whitelist */
        $whitelist = $context->getSalesChannel()->getMaintenanceIpWhitelist() ?: [];

        if(\in_array($ip, $whitelist)){
            return;
        }

        $whitelist[] = $ip;

        $this->salesChannelRepository->update([
            [
                'id' => $context->getSalesChannelId(),
                'maintenanceIpWhitelist' => $whitelist
            ]
        ], $context->getContext());

    }

}