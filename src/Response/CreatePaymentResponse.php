<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Exception\ErrorCodeException;
use Comgate\Exception\InvalidArgumentException;

class CreatePaymentResponse extends BaseResponse
{
    /**
     * @var string
     */
    private $transId;

    /**
     * @var string
     */
    private $redirect;


    /**
     * @param array $rawData
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct(array $rawData)
    {
        parent::__construct($rawData);

        if (isset($rawData['transId'])) {
            $this->transId = $rawData['transId'];
        } else {
            throw new InvalidArgumentException('Missing "transId" in response');
        }

        if (isset($rawData['redirect'])) {
            $this->redirect = $rawData['redirect'];
        } else {
            throw new InvalidArgumentException('Missing "redirect" in response');
        }
    }


    /**
     * @return string
     */
    public function getTransId(): string
    {
        return $this->transId;
    }


    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirect;
    }
}
