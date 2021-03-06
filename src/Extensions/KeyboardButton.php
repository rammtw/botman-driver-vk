<?php

namespace BotMan\Drivers\VK\Extensions;

use Illuminate\Support\Collection;

/**
 * Class KeyboardButton.
 */
class KeyboardButton implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $type = 'text';

    /**
     * @var array
     */
    protected $payload = [];

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $color = 'default';

    /**
     * @param $label
     * @param array $payload
     * @return KeyboardButton
     */
    public static function create($label, array $payload)
    {
        return new self($label, $payload);
    }

    /**
     * KeyboardButton constructor.
     * @param $label
     */
    public function __construct($label, array $payload)
    {
        $this->label = $label;
        $this->payload = json_encode($payload);
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function color($color = 'default')
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON.
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return Collection::make([
            'action' => [
                'type' => $this->type,
                'payload' => $this->payload,
                'label' => $this->label
            ],
            'color' => $this->color
        ])->filter()->toArray();
    }
}
