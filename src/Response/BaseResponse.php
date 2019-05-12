<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Enum\ResponseCode;
use Comgate\Exception\ErrorCodeException;
use Comgate\Exception\InvalidArgumentException;

abstract class BaseResponse
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * @param array $rawData
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct(array $rawData)
    {
        if (isset($rawData['code'])) {
            $this->code = (int)$rawData['code'];
        } else {
            throw new InvalidArgumentException('Missing "code" in response');
        }

        if (isset($rawData['message'])) {
            $this->message = $rawData['message'];
        } else {
            throw new InvalidArgumentException('Missing "message" in response');
        }

        if (!$this->isOk()) {
            throw new ErrorCodeException($this->message, $this->code);
        }
    }


    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->code === ResponseCode::CODE_OK;
    }


    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
