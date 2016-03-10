<?php 
namespace SoftwareFeedBundle\Handler;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutSuccessHandler  implements LogoutSuccessHandlerInterface {
    public function onLogoutSuccess(Request $request) {
        $target_url = $request->query->get('target_url') ? $request->query->get('target_url') : "/";
        return new RedirectResponse($target_url);
    }
}
?>