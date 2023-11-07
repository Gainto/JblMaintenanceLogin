<?php declare(strict_types=1);

namespace JblMaintenanceLogin\Storefront\Controller;

use JblMaintenanceLogin\Storefront\Services\WhitelistService;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MaintenanceLoginController
 * @package JblMaintenanceLogin\Storefront\Controller
 * @author Jeffry Block <hello@jeffblock.de>
 */
#[Route(defaults: ['_routeScope' => ['storefront'], 'allow_maintenance' => true, '_httpCache' => false], methods:["POST"])]
class MaintenanceLoginController extends StorefrontController
{
    public function __construct(
        private readonly SystemConfigService $systemConfigService,
        private readonly WhitelistService $whitelistService
    ) {
    }

    /**
     * @param Request $request
     * @param SalesChannelContext $context
     * @return Response
     * @author Jeffry Block <hello@jeffblock.de>
     */
    #[Route(path: '/maintenance-login', name: 'frontend.maintenance.login')]
    public function index(Request $request, SalesChannelContext $context): Response
    {

        /** @var string $providedPass */
        $providedPass = $request->get("login", "");

        /** @var string $configPass */
        $configPass = $this->systemConfigService->get("JblMaintenanceLogin.config.password", $context->getSalesChannelId()) ?: "";

        if($providedPass != $configPass){
            return $this->redirectToRoute("frontend.maintenance.page");
        }

        $this->whitelistService->whitelist(
            $request->getClientIp(),
            $context->getSalesChannelId(),
            $context
        );

        return $this->redirectToRoute("frontend.home.page");
    }

}