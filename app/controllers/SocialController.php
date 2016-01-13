<?php


class SocialController extends BaseController {

    public function getLogin() {


        // Session storage
        $storage = new Session();
        // Setup the credentials for the requests
        $credentials = new Credentials(
            $servicesCredentials['google']['1055839816416-t7c1qgi5t28nl53hl49lms891fkf43vp.apps.googleusercontent.com'],
            $servicesCredentials['google']['996cPBsP2K5YU2DJdbg75Mz2'],
            $currentUri->getAbsoluteUri()
        );
        // Instantiate the Google service using the credentials, http client and storage mechanism for the token
        /** @var $googleService Google */
        $googleService = $serviceFactory->createService('google', $credentials, $storage, array('userinfo_email', 'userinfo_profile'));
        if (!empty($_GET['code'])) {
            // retrieve the CSRF state parameter
            $state = isset($_GET['state']) ? $_GET['state'] : null;
            // This was a callback request from google, get the token
            $googleService->requestAccessToken($_GET['code'], $state);
            // Send a request with it
            $result = json_decode($googleService->request('userinfo'), true);
            // Show some of the resultant data
            echo 'Your unique google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        } elseif (!empty($_GET['go']) && $_GET['go'] === 'go') {
            $url = $googleService->getAuthorizationUri();
            header('Location: ' . $url);
        } else {
            $url = $currentUri->getRelativeUri() . '?go=go';
            echo "<a href='$url'>Login with Google!</a>";
        }
    }
    
}
