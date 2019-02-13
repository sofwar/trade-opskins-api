<?php

namespace SofWar\Opskins\Actions;

use SofWar\Opskins\ApiRequest;
use SofWar\Opskins\Exceptions\OpskinsClientException;
use SofWar\Opskins\Resources\EmptyObject;
use SofWar\Opskins\Resources\IUser\CreateVCaseUser;
use SofWar\Opskins\Resources\IUser\GetProfile;
use SofWar\Opskins\Resources\IUser\Inventory;
use SofWar\Opskins\Resources\IUser\UpdateProfile;

class IUser
{
    /**
     * @var ApiRequest
     */
    private $request;

    public function __construct(ApiRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get Your Profile.
     *
     * https://api-trade.opskins.com/IUser/GetProfile/v1/
     *
     * @param bool $with_extra - Should we send sensitive user data? Defaults to false
     * @param string $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetProfile
     */
    public function get(bool $with_extra = false, string $access_token = null): GetProfile
    {
        $params = [
            'with_extra' => $with_extra,
        ];

        $body = $this->request->get('IUser/GetProfile', $params, [], $access_token);

        return new GetProfile($body);
    }

    /**
     * Update Your Profile.
     *
     * https://api-trade.opskins.com/IUser/UpdateProfile/v1/
     *
     * @param \SofWar\Opskins\Resources\Helpers\UpdateProfile|array $data
     * @param string $access_token
     *
     * @throws OpskinsClientException
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return UpdateProfile
     */
    public function update($data, string $access_token = null): UpdateProfile
    {
        $params = [];

        if ($data instanceof \SofWar\Opskins\Resources\Helpers\UpdateProfile) {
            $params = $data->toArray();
        } elseif (is_array($data)) {
            $params = $data;
        }

        if (!\count($params)) {
            throw new OpskinsClientException('Invalid arguments passed');
        }

        $body = $this->request->post('IUser/UpdateProfile', $params, [], $access_token);

        return new UpdateProfile($body);
    }

    /**
     * Reports a trade offer.
     *
     * @param string $message
     * @param int $offer_id
     * @param int $report_type
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return EmptyObject
     */
    public function report(string $message, int $offer_id, int $report_type = 3, string $access_token = null): EmptyObject
    {
        $params = [
            'message' => $message,
            'offer_id' => $offer_id,
            'report_type' => $report_type,
        ];

        $body = $this->request->post('IUser/UserReports', $params, [], $access_token);

        return new EmptyObject($body);
    }

    /**
     * @param string $name
     * @param string $site_url
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return CreateVCaseUser
     */
    public function createApiKeyCase(string $name, string $site_url): CreateVCaseUser
    {
        $params = [
            'display_name' => $name,
            'site_url' => $site_url,
        ];

        $body = $this->request->post('IUser/UserReports', $params);

        return new CreateVCaseUser($body);
    }

    /**
     * Get Your Inventory.
     *
     * https://api-trade.opskins.com/IUser/GetInventory/v1/
     *
     * @param int $app_id - Internal App ID
     * @param bool $filter_in_trade - Removes items that are part of an active trade from the response.
     * @param string|null $search - Additional search by item's name
     * @param int|null $sort
     * @param int $page - Page number in response (starting with 1, defaults to 1)
     * @param int $limit - Number of items per_page in response (no more than 500)
     * @param string $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return Inventory
     */
    public function inventory(int $app_id, bool $filter_in_trade = false, ?string $search = null, ?int $sort = null, int $page = 1, int $limit = 100, string $access_token = null): Inventory
    {
        $params = [
            'page' => $page,
            'per_page' => $limit,
            'sort' => $sort,
            'app_id' => $app_id,
            'search' => $search,
            'filter_in_trade' => $filter_in_trade,
        ];

        $body = $this->request->get('IUser/GetInventory', $params, [], $access_token);

        return new Inventory($body);
    }
}
