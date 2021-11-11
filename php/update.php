<?php

/**
 * Sends get request with cURL
 * @since 0.1.0
 */
function send_get(string $url) {
    $userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';

    //Initialize cURL.
    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );

    //Set the URL that you want to GET by using the CURLOPT_URL option.
    curl_setopt($ch, CURLOPT_URL, $url);

    //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    //Execute the request.
    $data = curl_exec($ch);

    //Close the cURL handle.
    curl_close($ch);

    return $data;
}

/**
 * Sends get request to api, and recives response data
 */
class Get {
    /**
     * Url of api
     */
    private string $url;

    /**
     * When class created
     * @param url Pass main url of api
     * @since 0.1.0
     */
    function __construct(string $url) {
        $this->url = $url;
    }

    /**
     * Send get request to api router and recives data
     * @param router Addr to send get request. example: github.com/sampleRouter
     * @since 0.1.0
     */
    public function get_data(string $router) {
        $response = send_get($this->url . $router);

        return $response;
    }

    /**
     * Send get request to api router and recives data and decoded in json
     * @param router Addr to send get request. example: github.com/sampleRouter
     * @since 0.1.0
     * @return object decoded json
     */
    public function get_data_as_json(string $router) {
        $response = send_get($this->url . $router);

        if (!$response) return array("message" => "Error: Response is null");

        return json_decode($response);
    }
}

/**
 * Github API
 */
class GithubApi {
    /**
     * Github api url
     */
    private string $url = "https://api.github.com";

    /**
     * Repository name
     */
    private string $repository;

    /**
     * Username
     */
    private string $username;

    /**
     * Get class
     */
    private Get $get;

    /**
     * When class creates
     * @since 0.1.0
     */
    function __construct(string $repo = "", string $username = "") {
        $this->repository = $repo;
        $this->username = $username;
        $this->get = new Get($this->url);
    }

    /**
     * Get repository releases detais as object
     * @since 0.1.0
     * @return object response or error
     */
    public function get_repo_releases() {
        $username = $this->username;
        $repo = $this->repository;

        if(empty($username) && empty($repo)) return array("message" => "Error");

        $response = $this->get->get_data_as_json("/repos/$this->username/$this->repository/releases");

        return $response;
    }
}

/**
 * Handle plugin update
 */
class Update {
    /**
     * Current version of plugin
     */
    private string $plugin_version;

    /**
     * When class created
     * @param current_version pass current version of plugin
     * @since 0.1.0
     */
    function __construct(string $current_version) {
        $this->plugin_version = $current_version;
    }

    /**
     * Checks version of plugin
     * If $version deferent than $this->plugin_version then return true, if not return false.
     * @since 0.1.0
     */
    private function check_version(string $version) {
        if ($this->plugin_version !== $version) {
            return true;
        }

        return false;
    }

    /**
     * Get latest version from GithubApi and return object (message)
     * @param username Github username
     * @param repo Github repository name
     * @since 0.1.0
     * @return object 
     */
    public function check_update(string $username, string $repo) {
        $api = new GithubApi($repo, $username);

        $version = $api->get_repo_releases()[0]->tag_name;

        if ($this->check_version($version)) return array($version, true);
        else return array($version, false);
    }
}

?>