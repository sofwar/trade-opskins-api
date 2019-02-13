<?php

namespace SofWar\Opskins\Resources;

use SofWar\Opskins\Actions\ITrade;
use SofWar\Opskins\Exceptions\OpskinsClientException;

class Offer extends BaseModel
{
    /**
     * Offer ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Offer sender's information.
     *
     * @var OfferUser
     */
    protected $sender;

    /**
     * Offer recipient's information.
     *
     * @var OfferUser
     */
    protected $recipient;

    /**
     * Offer state.
     *
     * @var int
     */
    protected $state;

    /**
     * State's display name e.g "Active".
     *
     * @var string
     */
    protected $state_name;

    /**
     * Message from sender to receiver. Max 190 characters.
     *
     * @var string
     */
    protected $message;

    /**
     * Whether or not this offer is a gift (you are not losing any items).
     *
     * @var bool
     */
    protected $is_gift;

    /**
     * Whether or not this offer is from a vCase website.
     *
     * @var bool
     */
    protected $is_case_opening;

    /**
     * Whether or not the offer was sent by you. Not outputted on no-auth endpoints.
     *
     * @var bool
     */
    protected $send_by_you;

    /**
     * Offer creation unix timestamp.
     *
     * @var int
     */
    protected $time_created;

    /**
     * Last update unix timestamp.
     *
     * @var int
     */
    protected $time_updated;

    /**
     * Offer expiration unix timestamp.
     *
     * @var int
     */
    protected $time_expires;

    /**
     * @var ITrade
     */
    private $ITrade;

    public function __construct(array $data, ITrade $ITrade = null)
    {
        $this->ITrade = $ITrade;

        $this->_update_data($data);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSender(): OfferUser
    {
        return $this->sender;
    }

    public function getRecipient(): OfferUser
    {
        return $this->recipient;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function getStateName(): string
    {
        return $this->state_name;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getIsGift(): bool
    {
        return $this->is_gift;
    }

    public function getIsCaseOpening(): bool
    {
        return $this->is_case_opening;
    }

    public function getSendByYou(): bool
    {
        return $this->send_by_you;
    }

    public function getTimeCreated(): int
    {
        return $this->time_created;
    }

    public function getTimeUpdated(): int
    {
        return $this->time_updated;
    }

    public function getTimeExpires(): int
    {
        return $this->time_expires;
    }

    /**
     * Accepts offer.
     *
     * @param int         $twofactor_code
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     * @throws OpskinsClientException
     */
    public function accept(int $twofactor_code, string $access_token = null): void
    {
        if ($this->ITrade === null) {
            throw new OpskinsClientException('ITrade not initialized');
        }

        $body = $this->ITrade->acceptOffer($this->id, $twofactor_code, $access_token);

        $data = $body->getOffer();

        $this->_update_data((array) $data);
    }

    /**
     * Cancel offer.
     *
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     * @throws OpskinsClientException
     */
    public function cancel(string $access_token = null): void
    {
        if ($this->ITrade === null) {
            throw new OpskinsClientException('ITrade not initialized');
        }

        $body = $this->ITrade->cancelOffer($this->id, $access_token);

        $this->_update_data((array) $body);
    }

    /**
     * Getting new information.
     *
     * @param string|null $access_token
     *
     * @throws OpskinsClientException
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function refresh(string $access_token = null): void
    {
        if ($this->ITrade === null) {
            throw new OpskinsClientException('ITrade not initialized');
        }

        $body = $this->ITrade->get($this->id, $access_token);

        $this->_update_data((array) $body);
    }

    /**
     * @param string      $message
     * @param int         $report_type
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function report(string $message, int $report_type = 3, string $access_token = null): void
    {
        $this->ITrade->reportOffer($message, (int) $this->id, $report_type, $access_token);
    }

    private function _update_data(array $data): void
    {
        $this->source = $data;

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if (\in_array($key, ['sender', 'recipient'], true) !== false) {
                    $value = new OfferUser($value);
                }

                $this->{$key} = $value;
            }
        }
    }
}
