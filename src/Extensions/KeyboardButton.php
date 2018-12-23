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
     * @return KeyboardButton
     */
    public static function create($label)
    {
        return new self($label);
    }

    /**
     * KeyboardButton constructor.
     * @param $label
     */
    public function __construct($label)
    {
        $this->label = $label;
    }

    /**
     * @param $text
     * @return $this
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param array $payload
     * @return $this
     */
    public function payload(array $payload)
    {
        $this->payload = json_encode($payload);

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
